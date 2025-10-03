<?php
require 'database/db.php';

$pdo = db_connect();

$fields = [
    'is_completed' => 1
];

$conditions = [
    'id' => $_GET['id']
];

db_update($pdo, 'todos', $fields, $conditions);

header("Location: index.php");