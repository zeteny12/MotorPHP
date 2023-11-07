<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once './Class/Database.php';
$db = new Database("localhost", "root", "", "eladomotorok");

if (!isset($_SESSION['login'])){
    $_SESSION['login'] = false;
}

    require_once './reszek/head.php';
$menu = filter_input(INPUT_GET, "menu");
?>

<body>
    <?php
    require_once './reszek/menu.php';
    require_once './tartalom.php';
    require_once './reszek/footer.php';
    ?>
</body>
</html>
