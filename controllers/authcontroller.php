<?php
session_start();
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../models/usuarios.php';

$usuarioModel = new Usuario($pdo);

if (isset($_POST['register'])) {
    $usuarioModel->registrar(
        $_POST['nombre'],
        $_POST['email'],
        $_POST['password']
        
    );
    header("Location: ../views/login.php");
    exit;
}

if (isset($_POST['login'])) {
    $user = $usuarioModel->buscarPorEmail($_POST['email']);

    if ($user && password_verify($_POST['password'], $user['contrausuarioscol'])) {

        $_SESSION['usuario'] = [
            'id' => $user['idusuarios'],
            'nombre' => $user['nomusuarios'],
            'email' => $user['emailusuarios'],
            'rol' => $user['rolusuarios']   // 👈 CLAVE
        ];

        header("Location: ../public/index.php");
        exit;

    } else {
        echo "Credenciales incorrectas";
    }
}

