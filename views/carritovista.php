<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include __DIR__ . '/../public/header.php'; 
?>

<div class="container">
    <h2>🛒 Tu Carrito de Compras</h2>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <div class="carrito-contenedor">
            <?php 
            $total = 0; 
            foreach ($_SESSION['carrito'] as $id => $item): 
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            ?>
                <div class="manga-card-carrito">
    <div>
        <strong><?= htmlspecialchars($item['nombre']) ?></strong><br>

        <?php if (!empty($item['volumen'])): ?>
            Volumen: <?= $item['volumen'] ?><br>
        <?php endif; ?>

        Cantidad: <?= $item['cantidad'] ?> | Precio: $<?= $item['precio'] ?>
    </div>

    <div>
        Subtotal: $<?= $subtotal ?>
        <a href="../controllers/eliminarcarritocon.php?id=<?= $id ?>">❌</a>
    </div>
</div>

            <?php endforeach; ?>

            <div style="text-align: right; margin-top: 20px; padding: 20px; background: #333; color: white; border-radius: 5px;">
                <h3>Total a pagar: $<?= $total ?></h3>
                <form action="../controllers/comprascontroller.php" method="POST">
                    <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; cursor: pointer;">Finalizar Compra</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p style="text-align: center;">El carrito está vacío. <a href="../public/index.php">Volver al catálogo</a></p>
    <?php endif; ?>

    
</div>
