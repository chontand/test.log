<?php

$filePath = __DIR__ . '/../DB/anekdots.json';
$data = json_decode(file_get_contents($filePath), true);

if ($data == NULL) {
    $data = array();
    $encodedData = json_encode($data);
    file_put_contents(__DIR__ . '/../DB/anekdots.json', $encodedData);
}

function addAnekdot($data, $id, $name, $kat, $anekdot, $point, $hodnota,  $width, $time, $volil)
{
    global $filePath;

    $newNote = array(
        'id' => $id,
        'name' => $name,
        'kategories_naw' => $kat,
        'anekdot' => $anekdot,
        'stars' => $point,
        'hodnota' => $hodnota,
        'width' => $width,
        'time' => $time,
        'volil' => $volil
    );

    array_push($data, $newNote);
    $encodedData = json_encode($data);
    file_put_contents($filePath, $encodedData);
}
