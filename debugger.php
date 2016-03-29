<?php
  class foo {
  	public $file = "access.log";
        public $data = "logs go here";
	function __destruct()
        {
	    file_put_contents($this->file, $this->data);  
        }
}
$file_name = $_GET['session_filename'];

print "Readfile " . $file_name ."<br>";
if(!file_exists($file_name))
{
  print "No file.<br><br>";
  print "In order to actually complete this exersize you need to be able to see the source which we have provided for you here.<br>";
  print "<br>";
  print "<?php<br>";
  print "<code>class foo {<br>";
  print "<code>      public \$file = \"access.log\";<br>";
  print "<code>      public \$data = \"logs go here\";<br>";
  print "<code>      function __destruct()<br>";
  print "<code>     {<br>";
  print "<code>          file_put_contents(\$this->file, \$this->data);<br>";
  print "<code>      }<br>";
  print "<code>}<br>";
  print "<code>\$file_name = \$_GET\[\'session_filename\'\];<br>";
  print "<code><br>";
  print "<code>print \"Readfile \" . \$file_name .\"&ltbr&gt\";<br>";
  print "<code>if(!file_exists(\$file_name))<br>";
  print "<code>{<br>";
  print "<code>No file.<br>";
  print "<code>In order to actually complete this exersize you need to be able to see 
the source which we have provided for you here.<br>";
  print "<code><br>";
  print "<code>}<br>";
  print "<code>else<br>";
  print "<code>{<br>";
  print "<code>  unserialize(file_get_contents(\$file_name));<br>";
  print "<code>}<br>";
  print "<code><br>";
}
else
{
  unserialize(file_get_contents($file_name));
}

print_r($_GET);

?>
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="userfile" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

