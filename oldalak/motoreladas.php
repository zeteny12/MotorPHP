<link rel="stylesheet" href="./css_script/motoreladas.css"/>

<h1>Hirdetés készítése</h1>
<div class="container">
    <div class="row">
        <form action="#" method="post" novalidate>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--GYARTO-->
                    <label for="Gyártó"><b>Gyártó:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Gyártó" id="Gyarto" name="Gyarto" minlength="3" maxlength="40" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--TIPUS-->
                    <label for="Típus"><b>Típus:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Típus" id="Tipus" name="Tipus" minlength="3" maxlength="40" autofocus required>
                    </div>
                </div>
            </div>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--EVJARAT-->
                    <label for="Évjárat"><b>Évjárat:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Évjárat" id="Evjarat" name="Evjarat" length="4" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--ALLAPOT-->
                    <label for="Állapot"><b>Állapot:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Állapot" id="Allapot" name="Allapot" minlength="2" maxlength="40" autofocus required>
                    </div>
                </div>
            </div>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--KOBCENTI-->
                    <label for="Köbcenti"><b>Köbcenti:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Köbcenti" id="Kobcenti" name="Kobcenti" minlength="1" maxlength="5" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--JOGOSITVANY-->
                    <label for="Jogosítvány"><b>Jogosítvány:</b></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Használathoz szükséges jogosítvány (B, A1, A2, A)" id="Jogositvany" name="Jogositvany" minlength="1" maxlength="15" autofocus required>
                    </div>
                </div>
            </div>
            <div class="from-group mb-4 row">
                <div class="col-6">
                    <!--TELJESITMENY-->
                    <label for="Teljesítmény"><b>Teljesítmény:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Teljesítmény (kW)" id="Teljesitmeny" name="Teljesitmeny" minlength="1" maxlength="4" autofocus required>
                    </div>
                </div>
                <div class="col-6">
                    <!--AR-->
                    <label for="Ár"><b>Ár:</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Ár forintban" id="Ar" name="Ar" minlength="1" maxlength="8" autofocus required>
                    </div>
                </div>
            </div>
            
                <button type="submit" class="btn btn-warning" name="eladasMegerosites" id="eladasMegerosites" value="true">Hirdetés feladása</button>
            
        </form>
    </div>
</div>