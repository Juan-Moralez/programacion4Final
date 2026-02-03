<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Agregar nuevo manga</h2>

<form action="../controllers/CrearMangaController.php" method="POST">

    <label>Nombre del manga</label><br>
    <input type="text" name="nommangas" required><br><br>

    <label>Autor</label><br>
    <input type="text" name="autormangas"><br><br>

    <label>Género</label><br>
    <input type="text" name="generosmangas"><br><br>

    <label>Cantidad de capítulos</label><br>
    <input type="number" name="cantcapitulosmangas"><br><br>

    <label>Cantidad de tomos</label><br>
    <input type="number" name="cantvolmangas"><br><br>

    <label>Stock</label><br>
    <input type="number" name="stockmangas" required><br><br>

    <label>Precio</label><br>
    <input type="number" name="preciomangas" required><br><br>

    <label>Descripción</label><br>
    <textarea name="descripcionmangas"></textarea><br><br>

    <button type="submit">Guardar manga</button>
</form>
