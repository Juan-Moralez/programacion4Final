<?php
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../models/mangas.php';

$mangaModel = new Mangas($pdo);
$mangas = $mangaModel->listar();
