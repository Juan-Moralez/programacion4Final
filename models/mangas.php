<?php
class Mangas {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM mangas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
