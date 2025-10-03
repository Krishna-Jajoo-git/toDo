<?php
require 'database/db.php';
if (isset($_POST['description'])) {
    
    if (empty($_POST['description']) || empty($_POST['due_date'])) {
        $errorMessage = "All fields are required";
    } else {
        $pdo = db_connect();
        
        $fields = [
            'description' => $_POST['description'],
            'due_date' => $_POST['due_date'],
            'is_completed' => 0,
        ];

        $result = db_insert($pdo, 'todos', $fields);

        if ($result) {
            $successMessage = "Todo created successfully";
        }
    }
}

require 'views/create.html';