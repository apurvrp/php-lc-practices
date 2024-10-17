<?php
error_reporting(E_ALL);

require 'functions.php';
// require 'router.php';


// Connect to the MySQL database.
$dsn = "mysql:host=localhost;port=3306;dbname=php_practices_01;user=root;charset=utf8mb4";

// Tip: This should be wrapped in a try-catch. We'll learn how, soon.
$pdo = new PDO($dsn);

$statement = $pdo->prepare("select * from posts");
$statement->execute();

// $posts = $statement->fetchAll(PDO::FETCH_BOTH);
// $posts = $statement->fetchAll(PDO::FETCH_NUM);
// $posts = $statement->fetchAll(PDO::FETCH_OBJ);
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
// $posts = $statement->fetchAll(PDO::FETCH_GROUP);
// $posts = $statement->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
// $posts = $statement->fetchAll(PDO::FETCH_UNIQUE);

dd($posts);

foreach ($posts as $post) {
    echo "<li>" . $post['title'] . "</li>";
}