<link rel="stylesheet" href="./css_script/felhasznalo.css"/>

<?php 
    $id = filter_input(INPUT_GET, "id");
    
    $BejelentkezettFelhasznalo = $db->getBejelentkezettFelhasznalo($id);

    if ($BejelentkezettFelhasznalo != null) {
        echo '<h1>'.$BejelentkezettFelhasznalo['vezeteknev'].' '.$BejelentkezettFelhasznalo['keresztnev'].'</h1>';
    }
?>

<a id="MotorEladas" href="index.php?menu=MotorEladas" class="btn btn-warning">Motor eladása</a>
<a id="MotorModositas" href="index.php?menu=FiokModositas" class="btn btn-success">Fiók módosítás</a>
<a id="FiokTorlese" href="index.php?menu=FiokTorlese" class="btn btn-danger">Fiók törlése</a>
