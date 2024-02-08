<link rel="stylesheet" href="./css_script/menu.css"/>

<navbar id="navigacio">
    <ul class="navlist">
        <li class="nav-item">
            <a href="index.php">Főoldal</a>
        </li>
        <li class="nav-item">
            <a class="<?php echo ($menu == 'Rolunk' ? 'active' : ''); ?>" href="index.php?menu=Rolunk">Rólunk</a>
        </li>
        <?php
            if ($_SESSION['login']) {
                foreach ($db->osszesfelhasznalo() as $row) {
                    echo '<li class="nav-item">
                        <a class="'.($menu == 'Felhasznalo' ? 'active' : '').'" href="index.php?menu=Felhasznalo&id='.$row['userid'].'">Felhasználó</a>
                    </li>';
                }
                echo '<li class="nav-item">
                    <a class="'.($menu == 'Kilepes' ? 'active' : '').'" href="index.php?menu=Kilepes">Kilépés</a>
                </li>';
            } else {
                echo '<li class="nav-item">
                        <a class="'.($menu == 'Bejelentkezes' ? 'active' : '').'" href="index.php?menu=Bejelentkezes">Bejelentkezés</a>
                      </li>
                      <li class="nav-item">
                        <a class="'.($menu == 'Regisztracio' ? 'active' : '').'" href="index.php?menu=Regisztracio">Regisztráció</a>
                      </li>';
            }
?>

    </ul>
</navbar>

<script src="./css_script/menu.js"></script>
