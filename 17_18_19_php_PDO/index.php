<?php

error_reporting(E_ALL);
require 'functions.php';
//require 'router.php';
require 'Database.php';

$config = require('config.php');
$db = new Database($config['database']);

// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_BOTH);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_NUM);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_OBJ);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_ASSOC);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_GROUP);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
// $posts = $db->query("select * from posts")->fetchAll(PDO::FETCH_UNIQUE);
$posts = $db->query("select * from posts where id >= 1")->fetchAll();

dd($posts);

foreach ($posts as $post) {
    echo "<li>" . $post['title'] . "</li>";
}