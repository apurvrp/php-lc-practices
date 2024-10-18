<?php

$config = require('config.php');
// require 'Database.php';
$db = new Database($config['database']);

$heading = 'Note';
$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
// ])->fetch();
])->findOrFail();

// if (! $note) {
//     abort();
// }
// if ($note['user_id'] !== $currentUserId) {
//     abort(Response::FORBIDDEN);
// }

authorize($note['user_id'] === $currentUserId);

require "views/note.view.php";