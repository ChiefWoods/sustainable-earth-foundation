<?php
$host = 'localhost';
$db = 'mytb';
$user = 'root';
$pass = '';
$attr = "mysql:host=$host;dbname=$db";
$table = 'tb_user';
$opts = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$response['debug'][] = 'Attempting to connect to the database';

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
    $response['debug'][] = 'Database connection successful';
} catch (\PDOException $e) {
    $response['error'] = 'Database connection failed: ' . $e->getMessage();
    $response['debug'][] = $response['error'];
    file_put_contents('debug_log.json', json_encode($response['debug'], JSON_PRETTY_PRINT));
    exit();
}
