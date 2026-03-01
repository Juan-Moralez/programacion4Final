<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
include __DIR__ . '/../public/header.php'; 
?>


<h2>Agregar nuevo manga</h2>

<form action="../controllers/crearmangacontroller.php" method="POST" enctype="multipart/form-data">

    <label>Nombre del manga</label><br>
    <input type="text" name="nommangas" required><br><br>

    <label>Autor</label><br>
    <input type="text" name="autormangas"><br><br>

    <label>Género</label><br>
    <input type="text" name="generosmangas"><br><br>

    <label>Cantidad de capítulos</label><br>
    <input type="number" name="cantcapitulosmangas"><br><br>

    <!-- ✅ PORTADA PRINCIPAL -->
    <label>Portada principal del manga</label><br>
    <input type="file" name="imagen" accept="image/*" required><br><br>

    <label>Cantidad de tomos</label><br>
    <input type="number" name="cantvolmangas" id="cantVol" min="1" onchange="generarVolumenes()" required><br><br>

    <h3>Portadas de volúmenes</h3>
    <div id="contenedor-volumenes"></div>

    <label>Stock</label><br>
    <input type="number" name="stockmangas" required><br><br>

    <label>Precio</label><br>
    <input type="number" name="preciomangas" required><br><br>

    <label>Descripción</label><br>
    <textarea name="descripcionmangas"></textarea><br><br>

    <button type="submit">Guardar manga</button>
</form>

<script>
function generarVolumenes() {
    const cantidad = parseInt(document.getElementById("cantVol").value) || 0;
    const contenedor = document.getElementById("contenedor-volumenes");

    contenedor.innerHTML = "";

    for (let i = 1; i <= cantidad; i++) {
        const bloque = document.createElement("div");
        bloque.style.marginBottom = "10px";

        bloque.innerHTML = `
            <strong>Volumen ${i}</strong><br>
            <input type="file" name="portada_volumen_${i}" accept="image/*">
        `;

        contenedor.appendChild(bloque);
    }
}
</script>

