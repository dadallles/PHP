<?php

session_start();

if(!isset($_SESSION['zalogowany']))
{
    header('Location: index.php');
    exit();
}

?>

<doctype html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
        <meta charset="utf-8" />
        <title>Logowanie</title>
    </head>
    <body>
        
<?php
        
echo "<h2>Witaj ".$_SESSION['login']."!</h2> <br />";
echo "Twój mail to: ".$_SESSION['mail'];
echo "<br /><br /><a href='wyloguj.php'>Wyloguj się!</a>";
        
?>
        
    </body>
</html>
