<link rel="stylesheet" href="./css_script/motoreladas.css"/>


<?php
    if (filter_input(INPUT_POST, "eladasMegerosites", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
    $error = false;
    $errormessage = "";

    $required_fields = array("gyarto", "tipus", "evjarat", "allapot", "kobcenti", "jogositvany", "kW", "ar");
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $error = true;
            $errormessage = '<div id="errormessage">*Minden mező kitöltése kötelező!*</div>';
        }
    }

    if ($error) {
        echo $errormessage;
    } else {
        $gyarto = filter_input(INPUT_POST, "gyarto");
        $tipus = filter_input(INPUT_POST, "tipus");
        $evjarat = filter_input(INPUT_POST, "evjarat");
        $allapot = filter_input(INPUT_POST, "allapot");
        $kobcenti = filter_input(INPUT_POST, "kobcenti");
        $jogositvany = filter_input(INPUT_POST, "jogositvany");
        $kW = filter_input(INPUT_POST, "kW");
        $ar = filter_input(INPUT_POST, "ar");
        
        $db->hirdetesKeszitese($gyarto, $tipus, $evjarat, $allapot, $kobcenti, $jogositvany, $ar, $kW);
        header("Location:index.php");
        }
    }
?>


<div class="container">
<div class="card position-relative">
        
        <!--KARTYA_CIM-->
        <div class="card-header text-center text-md-center">
            <h1 class="mb-0 fs-5">Hirdetés készítése</h1>
        </div>
        
        <!--KARTYA_TESTE-->
        <div class="card-body py-3">
            <form action="#" method="post" novalidate>
                <div class="from-group mb-4">

                    <!--Gyártó-->
                    <label for="gyarto"><b>Gyártó:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/iconsmind/outline/16/Motorcycle-icon.png" width="16" height="16">
                        </span>
                        <input type="text" class="form-control" placeholder="Gyártó" id="gyarto" name="gyarto" minlength="3" maxlength="40" autofocus>
                    </div>


                    <hr>
                    
                    <!--Típus-->
                    <label for="tipus"><b>Típus:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/iconsmind/outline/16/Motorcycle-icon.png" width="16" height="16">
                        </span>
                        <input type="text" class="form-control" placeholder="Típus" id="tipus" name="tipus" minlength="3" maxlength="40" autofocus>
                    </div>
                    
                    <hr>
                        
                    <!--Évjárat-->
                    <label for="evjarat"><b>Évjárat:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/custom-icon-design/mono-business-2/16/calendar-icon.png" width="16" height="16">
                        </span>
                        <input type="number" class="form-control" placeholder="Évjárat" id="evjarat" name="evjarat" maxlength="4" autofocus>
                    </div>
                    
                    <hr>
                        
                    <!--Állapot-->
                    <label for="allapot"><b>Állapot:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/iconsmind/outline/16/Motorcycle-icon.png" width="16" height="16">
                        </span>
                        <input type="text" class="form-control" placeholder="Állapot" id="allapot" name="allapot" minlength="2" maxlength="40" autofocus>
                    </div>
                    
                    <hr>
                        
                    <!--Köbcenti-->
                    <label for="kobcenti"><b>Köbcenti:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/pictogrammers/material/16/engine-icon.png" width="16" height="16">
                        </span>
                        <input type="number" class="form-control" placeholder="Köbcenti" id="kobcenti" name="kobcenti" minlength="1" maxlength="5" autofocus>
                    </div>
                    
                    <hr>
                        
                    <!--Jogosítvány-->
                    <label for="jogositvany"><b>Jogosítvány:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/pictogrammers/material/16/card-account-details-outline-icon.png" width="16" height="16">
                        </span>
                        <input type="text" class="form-control" placeholder="B, A1, A2, A" id="jogositvany" name="jogositvany" minlength="1" maxlength="15" autofocus>
                    </div>
                    
                    <hr>
                        
                    <!--Teljesítmény-->
                    <label for="kW"><b>Teljesítmény:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/pictogrammers/material/16/engine-icon.png" width="16" height="16">
                        </span>
                        <input type="number" class="form-control" placeholder="Teljesítmény (kW)" id="kW" name="kW" minlength="1" maxlength="4" autofocus>
                    </div>
                    
                    <hr>
                        
                    <!--Ár-->
                    <label for="ar"><b>Ár:</b></label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="https://icons.iconarchive.com/icons/icons8/ios7/16/Finance-Money-Box-icon.png" width="16" height="16">
                        </span>
                        <input type="text" class="form-control" placeholder="Ár forintban" id="ar" name="ar" minlength="1" maxlength="12" autofocus>
                    </div>
                    
                    <hr>
                    
                    <!--Kép feltöltése-->
                    <label for="eladasKep"><b>Kép feltöltése:</b></label>
                    <input type="file" class="form-control" id="eladasKep" name="eladasKep" autofocus>
                </div>
                <br>
                    
                <!--Hirdetés feladása-->
                <div class="d-grid">
                    <button type="submit" class="btn btn-warning" name="eladasMegerosites" id="eladasMegerosites" value="true">Hirdetés feladása</button>
                </div>
            </form>
        </div>
    </div>
    </div>

<!--FELTOLTOTT KEP ATHELYEZESE A 'KEPEK' MAPPABA-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eladasMegerosites'])) {
    // Célkönyvtár, ahova a képet szeretnénk feltölteni
    $targetDir = "../kepek/";
    // Az átmozgatandó fájl teljes elérési útja
    $targetFile = $targetDir . basename($_FILES["eladasKep"]["name"]);  //tipus?
    // A feltöltés sikerességét ellenőrző változó
    $uploadOk = 1;
    // A kép fájltípusának lekérdezése
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Ellenőrizd, hogy a fájl valóban kép-e
    $check = getimagesize($_FILES["eladasKep"]["tmp_name"]);
    if ($check === false) {
        echo "A fájl nem kép.";
        $uploadOk = 0;
    }
    // Korlátozd a fájltípusokat, ha szükséges
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Csak JPG, JPEG, PNG és GIF fájlok engedélyezettek.";
        $uploadOk = 0;
    }
    // Töltsd fel a fájlt, ha minden ellenőrzés sikeres
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["eladasKep"]["tmp_name"], $targetFile)) {
            echo "A fájl sikeresen feltöltve.";
        } else {
            echo "Hiba történt a fájl feltöltése közben.";
        }
    } else {
        echo "A fájl feltöltése sikertelen.";
    }
}
?>