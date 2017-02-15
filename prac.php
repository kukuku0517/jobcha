<?php 

$file = 'readme.txt';
$new = 'readme2.txt.bak';

echo $file;

copy($file, $new);

$files = file_get_contents('readme.txt');
echo $files;

 ?>