<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../public/index.php");
    exit;
}

$idManga = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM mangas WHERE idmangas = ?");
$stmt->execute([$idManga]);
$manga = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$manga) {
    die("El manga no existe.");
}


$stmtVol = $pdo->prepare("
    SELECT id_volumen, nro_volumen, portada_url 
    FROM volumenes_manga 
    WHERE id_manga = ?
");
$stmtVol->execute([$idManga]);
$volumenes = $stmtVol->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../public/visual/style.css">

<div class="container-detalle">

    <a href="../public/index.php">⬅ Volver al catálogo</a>

    <div class="manga-grid-detalle">

        
        <div class="manga-portada">
            <img 
                id="portada-actual"
                src="../public/<?= htmlspecialchars($manga['imagen_url'] ?: 'img/mangas/default.jpg') ?>"
                alt="<?= htmlspecialchars($manga['nommangas']) ?>">
        </div>

        
        <div class="manga-info">

            <h1><?= htmlspecialchars($manga['nommangas']) ?></h1>
            <p><strong>Autor:</strong> <?= htmlspecialchars($manga['autormangas']) ?></p>
            <p><?= htmlspecialchars($manga['descripcionmangas']) ?></p>

            <hr>

            
            <label for="selector-volumen">Elegir volumen:</label>

            <select id="selector-volumen" onchange="cambiarPortada(this)">
                <option data-img="../public/img/mangas/default.jpg">
                    Seleccione un tomo...
                </option>

                <?php foreach ($volumenes as $vol): ?>
                    <option 
                        data-img="../public/<?= htmlspecialchars($vol['portada_url']) ?>">
                        Volumen <?= $vol['nro_volumen'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <hr>

            
            <form action="../controllers/carritocontroller.php" method="POST">
                <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
                <input type="hidden" name="nommangas" value="<?= $manga['nommangas'] ?>">
                <input type="hidden" name="preciomangas" value="<?= $manga['preciomangas'] ?>">
                <input type="hidden" name="stockmangas" value="<?= $manga['stockmangas'] ?>">
                <button type="submit" class="btn-comprar">🛒 Comprar</button>
            </form>

            
            <form action="../controllers/deseadoscon.php" method="POST">
                <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
                <button type="submit" class="btn-wishlist">❤️ Añadir a deseados</button>
            </form>

        </div>
    </div>
</div>

<script>
function cambiarPortada(select) {
    const opcion = select.options[select.selectedIndex];
    const imagen = opcion.getAttribute('data-img');
    document.getElementById('portada-actual').src = imagen;
}
</script>

