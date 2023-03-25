<?php
$connect_anekdots = __DIR__ . '/../DB/anekdots.json';
if (!$connect_anekdots) {
   die('Error connect to DataBase ');
}

$connect_notes = __DIR__ . '/../DB/notes.json';
if (!$connect_notes) {
   die('Error connect to DataBase ');
}
