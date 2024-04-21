<?php

class Database {
    
    private $db = null;
    public $error = false;
    
    
      public function __construct($host, $username, $pass, $db) {
        try {
            $this->db = new mysqli($host, $username, $pass, $db);
            $this->db->set_charset("utf8");
        } catch (Exception $ex) {
            $this->error = true;
            echo '<p>Az adatbázis nem elérhető!</p>';
            exit();
        }
    }
    
    public function prepare($sql) {
        if ($this->db) {
            return $this->db->prepare($sql);
        } else {
            throw new Exception("Nincs adatbázis kapcsolat inicializálva.");
        }
    }
    
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT `e-mail_cim`, `jelszo`, userid FROM `users` WHERE `e-mail_cim` LIKE ?;");
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row && password_verify($password, $row['jelszo'])) {
                var_dump($row);
                $_SESSION['InputEmail'] = $row['e-mail_cim'];
                $_SESSION['login'] = true;
                $_SESSION['userid'] = $row['userid'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['InputEmail'] = '';
                $_SESSION['login'] = false;
                header("Location: index.php?menu=Bejelentkezes");
                exit();
            }
            $result->free_result();
        }
        return false;      
    }
    
    public function register($vezeteknev, $keresztnev, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO `users`(`vezeteknev`, `keresztnev`, `e-mail_cim`, `jelszo`, `userid`) VALUES (?,?,?,?,NULL)");
        $stmt->bind_param("ssss", $vezeteknev, $keresztnev, $email, $password);
        try {
            if ($stmt->execute()) {
                $_SESSION['login'] = true;
                $_SESSION['userid'] = $this->db->insert_id;
            } else {
                $_SESSION['login'] = false;
                echo '<p>Rögzítés sikertelen!</p>';
            }
        } catch (Exception $ex) {
            $this->error = true;
        }
    }

    public function osszesmotor() {
        $result = $this->db->query("SELECT * FROM `motor`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKivalasztottMotor($motorId) {
        $stmt = $this->db->prepare("SELECT * FROM `motor` WHERE `motorid` = ?");
        $stmt->bind_param("i", $motorId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function hirdetesKeszitese($gyarto, $tipus, $evjarat, $allapot, $kobcenti, $jogositvany, $ar, $kW) {
        $stmt = $this->db->prepare("INSERT INTO `motor`(`gyarto`, `tipus`, `evjarat`, `allapot`, `kobcenti`, `jogositvany`, `ar`, `kW`) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssisisss", $gyarto, $tipus, $evjarat, $allapot, $kobcenti, $jogositvany, $ar, $kW);
        try {
            if ($stmt->execute()) {
                echo 'Hirdetés sikeresen feladva!';
            } else {
                echo 'Hirdetés feladása sikertelen! Hiba: ' . $stmt->error;
            }
        } catch (Exception $ex) {
            $this->error = true;
            echo 'Hiba: ' . $ex->getMessage();
            var_dump($stmt);
        }
    }

    public function osszesfelhasznalo() {
        $result = $this->db->query("SELECT * FROM `users`");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBejelentkezettFelhasznalo($userid) {
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `userid` = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

   public function frissitFelhasznalo($userid, $vezeteknev, $keresztnev, $email, $jelszo) {
        try {
            if (!is_null($jelszo)) {
                $jelszo = password_hash($jelszo, PASSWORD_DEFAULT);
                $sql = "UPDATE `users` SET `vezeteknev` = ?, `keresztnev` = ?, `e-mail_cim` = ?, `jelszo` = ? WHERE `userid` = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('ssssi', $vezeteknev, $keresztnev, $email, $jelszo, $userid);
            } else {
                $sql = "UPDATE `users` SET `vezeteknev` = ?, `keresztnev` = ?, `e-mail_cim` = ? WHERE `userid` = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param('sssi', $vezeteknev, $keresztnev, $email, $userid);
            }

            if ($stmt->execute()) {
                $frissitesUzenet = "Sikeres frissítés!";
            } else {
                $frissitesUzenet = "A frissítés nem sikerült! Hiba: " . $stmt->error;
            }
        } catch (Exception $e) {
            $frissitesUzenet = "Hiba a felhasználó frissítésekor: " . $e->getMessage();
        }

        $_SESSION['frissitesUzenet'] = $frissitesUzenet;
        header("Location: index.php");
        exit();
    }
    
    public function felhasznaloTorles($email, $jelszo) {
        //-- a felhasználót csak akkor törölhetem, ha nem szerepel a vásárlás táblában
        //DELETE FROM `vasarlas` WHERE `userid` = {id};
        $sql = "DELETE FROM users WHERE `e-mail_cim` = ? AND `jelszo` = ?";
        
        $stmt = $this->db->prepare($sql);

        if ($stmt) {
            $hashedPassword = $this->hashPassword($jelszo); 
            $stmt->bind_param("ss", $email, $hashedPassword);

            if ($stmt->execute()) {
                error_log('Sikeres felhasználó törlés: ' . $email); 
                return true;
            } else {
                error_log('Sikertelen felhasználó törlés: ' . $stmt->error); 
                return false;
            }
        } else {
            error_log('Felhasználó törlés előkészítése sikertelen: ' . $stmt->error); 
            return false;
        }
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE `e-mail_cim` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
   
   public function hashPassword($jelszo) {
        return password_hash($jelszo, PASSWORD_DEFAULT);
    }

    
    public function verifyPassword($jelszo, $hashedPassword) {
        return password_verify($jelszo, $hashedPassword);
    }

    public function vasarlasLeadasa($irszam, $varos, $unev_hszam, $emelet_ajto, $telefonszam, $userid, $motorid){
        $stmt = $this->db->prepare("INSERT INTO `vasarlas` (`irszam`, `varos`, `unev_hszam`, `emelet_ajto`, `telefonszam`, `userid`, `motorid`) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("issssii", $irszam, $varos, $unev_hszam, $emelet_ajto, $telefonszam, $userid, $motorid);
        try{
            if ($stmt->execute()){
                echo '<p>Vásárlás sikeresen leadva!</p>';
                header("Location: index.php");
            } else{
                echo '<p>Rögzítés sikertelen</p>';
                header("Location: index.php?menu=Bejelentkezes");
            }
        } catch (Exception $ex) {
            $this->error = true;
        }
    }
}
