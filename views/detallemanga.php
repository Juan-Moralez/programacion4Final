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
    ORDER BY nro_volumen ASC
");
$stmtVol->execute([$idManga]);
$volumenes = $stmtVol->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include __DIR__ . '/../public/header.php'; ?>

<div class="container-detalle">

    <a href="../public/index.php">⬅ Volver al catálogo</a>

    <div class="manga-grid-detalle">

        <div class="manga-info">

            <h1><?= htmlspecialchars($manga['nommangas']) ?></h1>

            
            <div class="manga-portada">
                <img 
                    id="portada-actual"
                    src="<?php
                        if (!empty($volumenes)) {
                            echo '../public/' . htmlspecialchars($volumenes[0]['portada_url']);
                        } else {
                            echo '../public/' . htmlspecialchars($manga['imagen_url'] ?: 'img/portadas/default.jpg');
                        }
                    ?>"
                    alt="<?= htmlspecialchars($manga['nommangas']) ?>"
                >
            </div>

            <p><strong>Autor:</strong> <?= htmlspecialchars($manga['autormangas']) ?></p>

            <p class="descripcion-manga">
                <?= nl2br(htmlspecialchars($manga['descripcionmangas'])) ?>
            </p>

            
            <?php if (count($volumenes) > 1): ?>
                <label>Elegir volumen:</label>

                <select id="selector-volumen" onchange="cambiarPortada(this)">
                    <?php foreach ($volumenes as $vol): ?>
                        <option 
                            value="<?= $vol['nro_volumen'] ?>"
                            data-img="../public/<?= htmlspecialchars($vol['portada_url']) ?>">
                            Volumen <?= $vol['nro_volumen'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            
            <form action="../controllers/carritocontroller.php" method="POST">
                <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
                <input type="hidden" name="nommangas" value="<?= $manga['nommangas'] ?>">
                <input type="hidden" name="preciomangas" value="<?= $manga['preciomangas'] ?>">
                <input type="hidden" name="stockmangas" value="<?= $manga['stockmangas'] ?>">
                <input type="hidden" id="input-volumen" name="volumen" value="<?= !empty($volumenes) ? $volumenes[0]['nro_volumen'] : 1 ?>">

                <button type="submit">🛒 Comprar</button>
            </form>

            
            <form action="../controllers/deseadoscon.php" method="POST">
                <input type="hidden" name="idmanga" value="<?= $manga['idmangas'] ?>">
                <button type="submit">❤️ Añadir a deseados</button>
            </form>

        </div>
    </div>
</div>

<script>
function cambiarPortada(select) {
    const opcion = select.options[select.selectedIndex];
    const imagen = opcion.getAttribute('data-img');
    const volumen = opcion.value;

    document.getElementById('portada-actual').src = imagen;
    document.getElementById('input-volumen').value = volumen;
}
</script>

