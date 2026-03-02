<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include __DIR__ . '/../public/header.php';

$idUsuario = $_SESSION['usuario']['id'];

   $stmt = $pdo->prepare("
    SELECT c.id_compra, c.fecha, c.total,
           d.nombre, d.precio, d.cantidad, d.volumen
    FROM compras c
    JOIN detalle_compra d ON c.id_compra = d.id_compra
    WHERE c.id_usuario = ?
    ORDER BY c.id_compra DESC
");

$stmt->execute([$idUsuario]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$agrupadas = [];
foreach ($rows as $r) {
    $agrupadas[$r['id_compra']]['info'] = [
        'fecha' => $r['fecha'],
        'total' => $r['total']
    ];
    $agrupadas[$r['id_compra']]['items'][] = $r;
}
?>

<h2>📦 Mis compras</h2> 

<?php foreach ($agrupadas as $id => $compra): ?>
  <div class="compra">
    <strong>Compra #<?= $id ?></strong><br>
    Fecha: <?= $compra['info']['fecha'] ?><br>
    Total: $<?= $compra['info']['total'] ?>
    <ul>
      <?php foreach ($compra['items'] as $it): ?>
        <li>
    <?= htmlspecialchars($it['nombre']) ?>

    <?php if (!empty($it['volumen'])): ?>
        — Volumen <?= htmlspecialchars($it['volumen']) ?>
    <?php endif; ?>

    — <?= $it['cantidad'] ?> x $<?= $it['precio'] ?>
</li>

      <?php endforeach; ?>
    </ul>
    <hr>
  </div>
<?php endforeach; ?>
