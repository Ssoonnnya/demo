<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Note';
$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', ['id' => $_GET['id']])->fetch();
$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->fetch();

if (! $note) {
    abort();
}

if ($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "view/note.view.php";

?>