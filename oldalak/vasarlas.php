<link rel="stylesheet" href="./css_script/vasarlas.css"/>

<?php
if (filter_input(INPUT_POST, "VasarlasVeglegesitese", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $motorid = filter_input(INPUT_POST, "motorid", FILTER_SANITIZE_NUMBER_INT);
    $error = false;
    $irszam = filter_input(INPUT_POST, "InputPostalCode");
    $varos = htmlspecialchars(filter_input(INPUT_POST, "inputCity"));
    $unev_hszam = filter_input(INPUT_POST, "inputStreetNameNumber");
    $emelet_ajto = filter_input(INPUT_POST, "inputFloorDoor");
    $telefonszam = filter_input(INPUT_POST, "inputPhoneNumber");

    if (empty($irszam) || empty($varos) || empty($unev_hszam) || empty($telefonszam)) {
        $error = true;
    }
    if ($error) {
        echo '<div id="minden-mezo">*A csillaggal (*) jelölt mezőket töltse ki!*</div>';
    } else {
        $db->vasarlasLeadasa($irszam, $varos, $unev_hszam, $emelet_ajto, $telefonszam, $_SESSION["userid"], $motorid);
        header("Location:index.php");
    }
}
?>

<div class="container" id="vasarlas-cont">
    <div class="row">
        <!--First Col-->
        <div class="col-5">
            <!--Content Card-->
            <div class="card position-relative">

                <!--Card Header-->
                <div class="card-header text-center text-md-center">
                    <h1 class="mb-0 fs-5">Szállítási Adatok</h1>
                </div>

                <!--Kard Body-->
                <div class="card-body py-3">
                    <form action="#" method="post" novalidate>
                        <div class="from-group mb-4">

                            <!--Postal Code-->
                            <label for="InputPostalCode"><b>Irányítószám:</b></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span class="fas fa-envelope">
                                        <img src="https://icons.iconarchive.com/icons/iconsmind/outline/128/Mail-3-icon.png" width="16" height="16">
                                    </span>
                                </span>
                                <input type="number" class="form-control" placeholder="Pl.: 4225*" id="InputPostalCode" name="InputPostalCode" autofocus required>
                            </div>
                            <hr>
                            <!--City-->
                            <label for="inputCity"><b>Város:</b></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span class="fas fa-envelope">
                                        <img src="https://icons.iconarchive.com/icons/iconoir-team/iconoir/128/city-icon.png" width="16" height="16">
                                    </span>
                                </span>
                                <input type="text" class="form-control" placeholder="Pl.: Debrecen*" id="inputCity" name="inputCity" autofocus>
                            </div>
                            <hr>
                            <!--Street Name-Number-->
                            <label for="inputStreetNameNumber"><b>Utcanév és Házszám:</b></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span class="fas fa-envelope">
                                        <img src="https://icons.iconarchive.com/icons/bootstrap/bootstrap/16/Bootstrap-geo-alt-icon.png" width="16" height="16">
                                    </span>
                                </span>
                                <input type="text" class="form-control" placeholder="Pl.: Ispotály utca 22*" id="inputStreetNameNumber" name="inputStreetNameNumber" autofocus>
                            </div>
                            <hr>
                            <!--Floor-Door-->
                            <label for="inputFloorDoor"><b>Emelet-Ajtó:</b></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span class="fas fa-envelope">
                                        <img src="https://icons.iconarchive.com/icons/bootstrap/bootstrap/16/Bootstrap-geo-alt-icon.png" width="16" height="16">
                                    </span>
                                </span>
                                <input type="text" class="form-control" placeholder="Pl.: 2/7" id="inputFloorDoor" name="inputFloorDoor">
                            </div>
                            <hr>
                            <!--Phone Number-->
                            <label for="inputPhoneNumber"><b>Telefonszám:</b></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <span class="fas fa-envelope">
                                        <img src="https://icons.iconarchive.com/icons/iconsmind/outline/16/Telephone-icon.png" width="16" height="16">
                                    </span>
                                </span>
                                <input type="text" class="form-control" placeholder="Pl.: +36 30 123 4567*" id="inputPhoneNumber" name="inputPhoneNumber" autofocus>
                            </div>
                            <hr>
                            <!--Payment Method-->
                            <label><b>Fizetési mód:</b></label>
                            <br>
                            <p id="PaymentMethodText">*Kizárólag bankkártyás fizetés*</p>
                        </div>
                        <br>
                        <!--Purchase Button-->
                        <div class="d-grid">
                            <button type="submit" name="VasarlasVeglegesitese" id="VasarlasVeglegesitese" class="btn btn-primary" value="true">Vásárlás Megerősítése</button>
                            <input type="hidden" name="motorid" value="<?php echo filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT); ?>" style="display: none;"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Second Col-->
        <div class="col-1">
            <!--For Place-->
        </div>

        <!--Third Col-->
        <div class="col-6">
            <?php
            $id = filter_input(INPUT_GET, "id");

            $motorAdatok = $db->getKivalasztottMotor($id);

            if ($motorAdatok != null) {
                echo '<h1 id="kivalaszott_motor_cim">' . $motorAdatok['gyarto'] . ' ' . $motorAdatok['tipus'] . ' (' . $motorAdatok['evjarat'] . ')</h1>';

                echo '<div class="container" id="jobb_oldali_motor_kep_es_tablazat">';
                echo '<div class="col-6 kozepre_igazitott_kep_tablazat">';
                $image = file_exists("./kepek/" . $motorAdatok['tipus'] . ".jpg") ? "./kepek/" . $motorAdatok['tipus'] . ".jpg" : "./kepek/noimage.jpg";
                echo '<img id="kivalaszott_motor_kep" src="' . $image . '" alt="' . $motorAdatok['tipus'] . ' képe" title="' . $motorAdatok['gyarto'] . ' ' . $motorAdatok['tipus'] . '">';
                echo '<br>';
                echo '</div>';
                echo '<div class="col-6 kozepre_igazitott_kep_tablazat" id="jobb_oldali_tablazat">';
                echo ' <table>
                                        <tr>
                                          <th class="tablazat_cimek"><p class="adat-parag">Gyártó:</p></th>
                                          <th class="tablazat_cimek"><p class="adat-parag">Típus:</p></th>
                                          <th class="tablazat_cimek"><p class="adat-parag">Évjárat:</p></th>
                                          <th class="tablazat_cimek"><p class="adat-parag">Állapot:</p></th>
                                        </tr>
                                        <tr>
                                          <td>' . $motorAdatok['gyarto'] . '</td>
                                          <td>' . $motorAdatok['tipus'] . '</td>
                                          <td>' . $motorAdatok['evjarat'] . '</td>
                                          <td>' . $motorAdatok['allapot'] . '</td>
                                        </tr>
                                        <tr>
                                          <th class="tablazat_cimek"><p class="adat-parag">Köbcenti</p><p class="adat-parag index_szoveg">(cm<sup>3</sup>):</p></th>
                                          <th class="tablazat_cimek"><p class="adat-parag">Jogosítvány:</p></th>
                                          <th class="tablazat_cimek"><p class="adat-parag">Teljesítmény</p><p class="adat-parag index_szoveg">(kW):</p></th>
                                          <th class="tablazat_cimek"><p class="adat-parag">Nálunk:</p></th>
                                        </tr>
                                        <tr>
                                          <td>' . $motorAdatok['kobcenti'] . '</td>
                                          <td>' . $motorAdatok['jogositvany'] . '</td>
                                          <td>' . $motorAdatok['kW'] . '</td>
                                          <td>' . $motorAdatok['nalunk'] . '</td>
                                        </tr>
                                    </table> ';
                echo '</div>';
                echo '</div>';
                echo '<div id="vasarlas_div_ar" class="tablazat_ar">' . $motorAdatok['ar'] . ' Ft</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
