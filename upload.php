<?php

  $uploaddir = '/var/www/html/dojo-basic/images/';
  $uploadfile = $uploaddir . basename ($_FILES['userfile']['name']);
  $tmpfile = $_FILES['userfile']['tmp_name'];
  $filename = $_FILES['userfile']['name'];

echo '$uploadfile is ' . $uploadfile . '<br>';
echo '<pre>';
move_uploaded_file($tmpfile,"images/".$filename);
echo "Success";

echo 'More Debugging Stuff';
print_r($_FILES);

print "</pre>";
?> 
