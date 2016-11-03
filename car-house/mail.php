<?php
$counter = 0;
$file = fopen("data.csv","r");
while(! feof($file)){
    $ar=fgetcsv($file);
    $counter++;
}

$message = "Today's visitor: ". $counter;
mail('me.sohelrana@gmail.com', 'Car House - Visitor Report', $message);
