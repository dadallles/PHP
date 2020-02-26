<?php
session_start();

if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] == true)
{
    header('Location: strona.php');
    exit;
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
        <h1>Zaloguj się!</h1>
        <form action="logowanie.php" method="post">
            Login: <br />
            <input type="text" name="login" /><br />
            Hasło: <br />
            <input type="password" name="haslo" /><br /><br />
            <input type="submit" value="Zaloguj" />
            
            <p style="font-weight: bold; "><a href="zaloz.php">Nie masz konta? Załóż je!</a></p>
            
            <?php
            if(isset($_SESSION['blad']))
                {
                echo $_SESSION['blad'];
                }
            unset($_SESSION['blad']);
            ?>
            
        </form>
    </body>
</html>