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
    
    public function login($email, $password){
    $stmt = $this->db->prepare("SELECT `e-mail_cim`, `jelszo` FROM `users` WHERE `e-mail_cim` LIKE ?;");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && password_verify($password, $row['jelszo'])) {
            $_SESSION['InputEmail'] = $row['e-mail_cim'];
            $_SESSION['login'] = true;
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

    
    public function register($vezeteknev, $keresztnev, $email, $password){
        $stmt = $this->db->prepare("INSERT INTO `users`(`vezeteknev`, `keresztnev`, `e-mail_cim`, `jelszo`, `userid`) VALUES (?,?,?,?,NULL)");
        $stmt->bind_param("ssss", $vezeteknev, $keresztnev, $email, $password);
        try{
            if ($stmt->execute()){
                $_SESSION['login'] = true;
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
        try{
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
    
    public function getBejelentkezettFelhasznalo($userid){
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `userid` = ?");
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0){
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
    public function vasarlasLeadasa($irszam, $varos, $unev_hszam, $emelet_ajto, $telefonszam){
        $stmt = $this->db->prepare("INSERT INTO `vasarlas` (`irszam`, `varos`, `unev_hszam`, `emelet_ajto`, `telefonszam`, `userid`, `motorid`, `vasarlas_idopontja`) VALUES (?,?,?,?,?,1,1,CURRENT_TIMESTAMP)");
        $stmt->bind_param("issss", $irszam, $varos, $unev_hszam, $emelet_ajto, $telefonszam);
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