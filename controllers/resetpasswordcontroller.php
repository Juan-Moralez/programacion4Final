<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_POST['token'], $_POST['password'])) {
    die("Datos incompletos");
}

$token = $_POST['token'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

/* VALIDAR TOKEN */
$stmt = $pdo->prepare("
    SELECT idusuarios 
    FROM usuarios
    WHERE token_recuperacion = ?
    AND token_expira > NOW()
");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Token inválido o expirado");
}

/* ACTUALIZAR PASSWORD */
$stmt = $pdo->prepare("
    UPDATE usuarios 
    SET contrausuarioscol = ?, 
        token_recuperacion = NULL,
        token_expira = NULL
    WHERE idusuarios = ?
");
$stmt->execute([$password, $user['idusuarios']]);

/* MENSAJE TEMPORAL */
$_SESSION['password_actualizada'] = true;

/* REDIRIGIR */
header("Location: ../views/login.php");
exit;
