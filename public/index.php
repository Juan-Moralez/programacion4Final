<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

require_once __DIR__ . '/../controllers/MangaCon.php';
include __DIR__ . '/../public/header.php';
?>

<div class="container">
    <h1>Catálogo de Mangas</h1>

    <div class="manga-grid">
        <?php foreach ($mangas as $manga): ?>
            <div class="manga-card">

                <h3><?= htmlspecialchars($manga['nommangas']) ?></h3>

                <img 
                    src="<?= htmlspecialchars($manga['imagen_url'] ?: 'img/mangas/default.jpg') ?>" 
                    alt="<?= htmlspecialchars($manga['nommangas']) ?>"
                    class="manga-img"
                >

                <p>Autor: <?= htmlspecialchars($manga['autormangas']) ?></p>
                <p>Precio: $<?= $manga['preciomangas'] ?></p>

                <a href="../views/detallemanga.php?id=<?= $manga['idmangas'] ?>" class="btn-detalle">
                    Ver más
                </a>

                <!-- BOTÓN CORRECTO PARA TU CONTROLLER -->
                <form action="../controllers/carritocontroller.php" method="POST">
    <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
    <input type="hidden" name="nommangas" value="<?= htmlspecialchars($manga['nommangas']) ?>">
    <input type="hidden" name="preciomangas" value="<?= $manga['preciomangas'] ?>">
    <input type="hidden" name="stockmangas" value="<?= $manga['stockmangas'] ?>">
    <input type="hidden" name="volumen" value="1"> <!-- compra general sin volumen -->
    <button type="submit">Agregar al carrito</button>
</form>


                <?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
                    <form action="../controllers/eliminarmangacontroller.php" method="POST">
                        <input type="hidden" name="idmangas" value="<?= $manga['idmangas'] ?>">
                        <button type="submit" onclick="return confirm('¿Eliminar?')">
                            Eliminar
                        </button>
                    </form>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
</div>
