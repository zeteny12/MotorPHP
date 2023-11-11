<link rel="stylesheet" href="./css_script/motorEladas.css"/>


<?php
    if (filter_input(INPUT_POST, "eladasMegerosites", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
        $error = false;
        $errormessage = "";
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
?>


<h1>Hirdetés készítése</h1>
<div class="container">
    <div class="row">
        <form action="#" method="post" novalidate onsubmit="return teljesKitoltes()">
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--GYARTO-->
                    <label for="Gyártó"><b>Gyártó:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Gyártó" id="gyarto" name="gyarto" minlength="3" maxlength="40" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--TIPUS-->
                    <label for="Típus"><b>Típus:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Típus" id="tipus" name="tipus" minlength="3" maxlength="40" autofocus required>
                    </div>
                </div>
            </div>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--EVJARAT-->
                    <label for="Évjárat"><b>Évjárat:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Évjárat" id="evjarat" name="evjarat" maxlength="4" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--ALLAPOT-->
                    <label for="Állapot"><b>Állapot:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Állapot" id="allapot" name="allapot" minlength="2" maxlength="40" autofocus required>
                    </div>
                </div>
            </div>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--KOBCENTI-->
                    <label for="Köbcenti"><b>Köbcenti:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Köbcenti" id="kobcenti" name="kobcenti" minlength="1" maxlength="5" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--JOGOSITVANY-->
                    <label for="Jogosítvány"><b>Jogosítvány:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Használathoz szükséges jogosítvány (B, A1, A2, A)" id="jogositvany" name="jogositvany" minlength="1" maxlength="15" autofocus required>
                    </div>
                </div>
            </div>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--TELJESITMENY-->
                    <label for="Teljesítmény"><b>Teljesítmény:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Teljesítmény (kW)" id="kW" name="kW" minlength="1" maxlength="4" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--AR-->
                    <label for="Ár"><b>Ár:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Ár forintban" id="ar" name="ar" minlength="1" maxlength="8" autofocus required>
                    </div>
                </div>
            </div>
            <!--HIRDETES FELADASA GOMB-->
            <button type="submit" class="btn btn-warning" name="eladasMegerosites" id="eladasMegerosites" value="true">Hirdetés feladása</button>
        </form>
    </div>
</div>

<!--<script src="./css_script/motorEladas.js"></script>-->