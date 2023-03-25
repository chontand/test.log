<?php

$filePath_notes = __DIR__ . '/../DB/notes.json';

$data = json_decode(file_get_contents($filePath_notes), true);

if ($data == NULL) {
    $data = array();
    $encodedData = json_encode($data);
    file_put_contents(__DIR__ . '/../DB/notes.json', $encodedData);
}


function addNote($data, $name, $email, $psw, $psw_repeat, $phone, $volil_a)
{
    global $filePath_notes;

    $newNote = array(
        'id' => uniqid(),
        'name' => $name,
        'email' => $email,
        'pswHash' => password_hash($psw, PASSWORD_DEFAULT),
        'psw_repeat' => password_hash($psw_repeat, PASSWORD_DEFAULT),
        'phone' => $phone,
        'volil' => $volil_a
    );

    array_push($data, $newNote);
    $encodedData = json_encode($data);
    file_put_contents($filePath_notes, $encodedData);
}
