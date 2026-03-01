<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_POST['email'])) {
    header("Location: ../views/login.php");
    exit;
}

$email = $_POST['email'];

$stmt = $pdo->prepare("SELECT idusuarios FROM usuarios WHERE emailusuarios = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    $token = bin2hex(random_bytes(32));

    $stmt = $pdo->prepare("
        UPDATE usuarios 
        SET token_recuperacion = ?, token_expira = DATE_ADD(NOW(), INTERVAL 1 HOUR)
        WHERE idusuarios = ?
    ");
    $stmt->execute([$token, $user['idusuarios']]);

    $_SESSION['mensaje'] = "Se generó el enlace de recuperación.";
    $_SESSION['link_recuperacion'] = "http://localhost/Programacion4Final/views/resetpassword.php?token=$token";

} else {
    $_SESSION['mensaje'] = "Si el email existe, recibirás un enlace.";
}

header("Location: ../views/recuperar.php");
exit; 
