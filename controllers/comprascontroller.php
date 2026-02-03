<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

if (empty($_SESSION['carrito'])) {
    header("Location: ../public/index.php");
    exit;
}

/* Simulación de compra */
$_SESSION['compra_realizada'] = true;

/* Vaciar carrito */
unset($_SESSION['carrito']);

header("Location: ../public/index.php");
exit;
