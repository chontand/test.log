<?php


function sortTime($res)
{
   for ($i = 0; $i < count($res); $i++) {
      for ($j = 0; $j < count($res); $j++) {
         if ($res[$i]['time'] < $res[$j]['time']) {
            $new = $res[$i];
            $old = $res[$j];
            $res[$j] = $new;
            $res[$i] = $old;

            $newJsonString = json_encode($res);
            file_put_contents(__DIR__ . '/../DB/anekdots.json', $newJsonString);
         }
      }
   }

   return $res;
}

function sortBest($res)
{
   for ($i = 0; $i < count($res); $i++) {
      for ($j = 0; $j < count($res); $j++) {
         if ($res[$i]['hodnota'] > $res[$j]['hodnota']) {
            $new = $res[$i];
            $old = $res[$j];
            $res[$j] = $new;
            $res[$i] = $old;

            $newJsonString = json_encode($res);
            file_put_contents(__DIR__ . '/../DB/anekdots.json', $newJsonString);
         }
      }
   }
   return $res;
}


function sortTimeNew($res)
{
   for ($i = 0; $i < count($res); $i++) {
      for ($j = 0; $j < count($res); $j++) {
         if ($res[$i]['time'] > $res[$j]['time']) {
            $new = $res[$i];
            $old = $res[$j];
            $res[$j] = $new;
            $res[$i] = $old;

            $newJsonString = json_encode($res);
            file_put_contents(__DIR__ . '/../DB/anekdots.json', $newJsonString);
         }
      }
   }
   return $res;
}
