<?php
header('Content-Type: application/json');
require __DIR__ . '/db.php';

$stmt = $pdo->query("SELECT id, title, slug, description, category FROM services ORDER BY id ASC");
$services = $stmt->fetchAll();

echo json_encode(['services' => $services]);
