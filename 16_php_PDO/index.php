<?php
error_reporting(E_ALL);

require 'functions.php';
//require 'router.php';
require 'Database.php';

$db = new Database();
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_BOTH);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_NUM);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_OBJ);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_ASSOC);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_GROUP);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_UNIQUE);
$posts = $db->query("select * from posts where id >= 1")->fetchAll(PDO::FETCH_ASSOC);

// dd($posts);

foreach ($posts as $post) {
    echo "<li>" . $post['title'] . "</li>";
}