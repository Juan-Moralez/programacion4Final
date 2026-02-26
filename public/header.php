<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliomania</title>
    <link rel="stylesheet" href="/Programacion4Final/public/visual/style.css">
</head>
<body>
<nav class="navbar">
    <div class="logo">
        <a href="/Programacion4Final/public/index.php" style="color: #ac1a325d">BIBLIOMANIA</a>
    </div>
    <div class="adminbtn">
    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
        <div>
            <a href="../views/crearmanga.php" class="btn-admin" >➕ Agregar nuevo manga</a>
        </div>
    <?php endif; ?>
    </div>
    <div class="nav-links">


        <a href="/Programacion4Final/public/index.php" style="color: #ccbc61a2">Inicio</a>
        
        <a href="/Programacion4Final/views/carritovista.php" style="color: #58c573">
            🛒 Carrito (<?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0 ?>)
        </a>

        <a href="../views/wishlist.php" style="color: #df6969">❤️ Mis deseados</a>
        
        <a href="/Programacion4Final/public/perfil.php" style="color: #5fb0c4">👤 Mi Perfil</a>

        <a href="../views/historial.php" style="color: #58a13b ">📦 Mis compras</a>

        
        <a href="/Programacion4Final/controllers/logout.php" style="color: #ffb3b3;">Cerrar sesion</a>

        
        

    </div>
</nav>