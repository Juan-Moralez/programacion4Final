<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

require_once __DIR__ . '/../controllers/MangaCon.php';
?>
<link rel="stylesheet" href="visual/style.css">
<div class="container">

<h1>Bibliomania</h1>   
<p>Bienvenido <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></p>
<a href="../controllers/logout.php">Cerrar sesión</a>

<?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
    <a href="../views/crearmanga.php">➕ Agregar manga</a>
    <hr>
<?php endif; ?>

<hr>

<hr>

<?php foreach ($mangas as $manga): ?>
  <div class="manga">
    <h3><?= htmlspecialchars($manga['nommangas']) ?></h3>
    <p>Autor: <?= htmlspecialchars($manga['autormangas']) ?></p>
    <p>Precio: $<?= $manga['preciomangas'] ?></p>
    <p>Stock: <?= $manga['stockmangas'] ?></p>
  </div>
  <form action="../controllers/CarritoController.php" method="POST">
    <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
    <input type="hidden" name="nombre" value="<?= htmlspecialchars($manga['nommangas']) ?>">
    <input type="hidden" name="precio" value="<?= $manga['preciomangas'] ?>">
    <input type="hidden" name="stock" value="<?= $manga['stockmangas'] ?>">
    <button type="submit">Agregar al carrito</button>
    
</form>
<?php if ($_SESSION['usuario']['rol'] === 'admin'): ?>
    <form action="../controllers/eliminarmangacontroller.php" method="POST" style="display:inline;">
        <input type="hidden" name="idmangas" value="<?= $manga['idmangas'] ?>">
        <button type="submit" onclick="return confirm('¿Eliminar este manga?')">
            Eliminar
        </button>
    </form>
<?php endif; ?>

<?php if (isset($_SESSION['compra_realizada'])): ?>
    <p style="color:green; font-weight:bold;">
        ✅ Compra realizada con éxito
    </p>
    <?php unset($_SESSION['compra_realizada']); ?>
<?php endif; ?>


<hr>
<h2>🛒 Carrito</h2>

<?php if (!empty($_SESSION['carrito'])): ?>
    <ul>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['carrito'] as $item): ?>
            <?php
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
            ?>
            <li>
                <?= htmlspecialchars($item['nombre']) ?> |
                Cantidad: <?= $item['cantidad'] ?> |
                Precio: $<?= $item['precio'] ?> |s
                Subtotal: $<?= $subtotal ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <strong>Total a pagar: $<?= $total ?></strong>

<?php else: ?>
    <p>El carrito está vacío</p>
<?php endif; ?>
<form action="../controllers/comprascontroller.php" method="POST">
    <button type="submit">Finalizar compra</button>
</form>
</div>


<?php endforeach; ?>
