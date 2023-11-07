<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="stylesheet" href="../css_script/kivalasztottMotor.css"/>
    <link rel="stylesheet" href="../css_script/footer.css"/>
    <title>Eladó motorok | Vásárlás</title>
</head>


<?php
    require_once '../Class/Database.php';
    $db = new Database("localhost", "root", "", "eladomotorok");
    
    if (isset($_GET['id'])) {
    $kivalasztottMotor = $_GET['id'];

    $motorAdatok = $db->getKivalasztottMotor($kivalasztottMotor);

    if ($motorAdatok) {
        echo '<h1 id="kivalaszott_motor_cim">'.$motorAdatok['gyarto'].' '.$motorAdatok['tipus'].' ('.$motorAdatok['evjarat'].')</h1>';
        
        
        echo '<div class="container">';
            echo '<div class="row d-flex">';
                echo '<div class="col-4">';
                    $image = file_exists("../kepek/" . $motorAdatok['tipus'] . ".jpg") ? "../kepek/" . $motorAdatok['tipus'] . ".jpg" : "../kepek/noimage.jpg";
                    echo '<img id="kivalaszott_motor_kep" src="' . $image . '" alt="' . $motorAdatok['tipus'] . ' képe" title="' . $motorAdatok['gyarto'] . ' ' . $motorAdatok['tipus'] . '">';
                echo '</div>';
                echo '<div class="col-1"></div>';
                echo '<div class="col-7">';
                    echo ' <table>
                            <tr>
                              <th class="tablazat_cimek"><p>Gyártó:</p></th>
                              <th class="tablazat_cimek"><p>Típus:</p></th>
                              <th class="tablazat_cimek"><p>Évjárat:</p></th>
                              <th class="tablazat_cimek"><p>Állapot:</p></th>
                            </tr>
                            <tr>
                              <td>'.$motorAdatok['gyarto'].'</td>
                              <td>'.$motorAdatok['tipus'].'</td>
                              <td>'.$motorAdatok['evjarat'].'</td>
                              <td>'.$motorAdatok['allapot'].'</td>
                            </tr>
                            <tr>
                              <th class="tablazat_cimek"><p>Köbcenti</p><p id="index_szoveg">(cm<sup>3</sup>):</p></th>
                              <th class="tablazat_cimek"><p>Jogosítvány:</p></th>
                              <th class="tablazat_cimek"><p>Teljesítmény</p><p id="index_szoveg">(kW):</p></th>
                              <th class="tablazat_cimek"><p>Nálunk:</p></th>
                            </tr>
                            <tr>
                              <td>'.$motorAdatok['kobcenti'].'</td>
                              <td>'.$motorAdatok['jogositvany'].'</td>
                              <td>'.$motorAdatok['kW'].'</td>
                              <td>'.$motorAdatok['nalunk'].'</td>
                            </tr>
                          </table> ';
                    
                    echo '<div id="vasarlas_div" class="d-flex justify-content-between align-items-center">
                                <div>
                                    <button type="button" class="btn btn-success">Vásárlás</button>
                                </div>
                                <div id="vasarlas_div_ar" class="tablazat_ar">'.$motorAdatok['ar'].' Ft</div>
                            </div>';
                    
                echo '</div>';
            echo '</div>';
        echo '</div>';
        
        require_once '../reszek/footer.php';
    } else {
        echo 'A kiválasztott motor nem található.';
    }
} else {
    echo 'Nincs megadva motor azonosító.';
}