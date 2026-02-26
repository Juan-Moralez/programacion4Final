<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../config/bd.php';

include __DIR__ . '/../public/header.php';

$idUsuario = $_SESSION['usuario']['id'];

$stmt = $pdo->prepare("
   SELECT m.*
    FROM wishlist w
    JOIN mangas m ON w.id_manga = m.idmangas
    WHERE w.id_usuario = ?

");
$stmt->execute([$idUsuario]);
$deseados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<link rel="stylesheet" href="../public/visual/style.css">

<div class="container">
<h1>❤️ Mi lista de deseados</h1>

<a href="../public/index.php">⬅ Volver a la tienda</a>
<hr>

<?php if (empty($deseados)): ?>
    <p>No tenés mangas en deseados.</p>
<?php endif; ?>



<?php foreach ($deseados as $manga): ?>
    <div class="manga">
        <h3><?= htmlspecialchars($manga['nommangas']) ?></h3>
        <p>Autor: <?= htmlspecialchars($manga['autormangas']) ?></p>
        <p>Precio: $<?= $manga['preciomangas'] ?></p>

        <form action="../controllers/carritocontroller.php" method="POST">
    <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
    <input type="hidden" name="nommangas" value="<?= $manga['nommangas'] ?>">
    <input type="hidden" name="preciomangas" value="<?= $manga['preciomangas'] ?>">
    <input type="hidden" name="stockmangas" value="<?= $manga['stockmangas'] ?>">
    <button type="submit">🛒 Comprar</button>
</form>


        <form action="../controllers/sacardeseados.php" method="POST">
            <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
            <button type="submit">❌ Quitar</button>
        </form>
    </div>
<?php endforeach; ?>
</div>
