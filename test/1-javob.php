<?php
$myarray = array(
    'hello' => 'world',
    'coding' => 'is cool',
);
$myArrayFile = fopen("myarray.json","w");
echo fwrite($myArrayFile, json_encode($myarray));
fclose($myArrayFile);

