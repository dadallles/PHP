<?php

session_start();

if(!isset($_POST['login']) || !isset($_POST['haslo']))
{
    header('Location: index.php');
    exit();
}

require_once"dane.php";

$polaczenie = @new mysqli($host, $user, $pass, $database);

if($polaczenie->connect_errno != 0)
{
    echo "Error ".$polaczenie->connect_errno;
}
else
{
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    $login = addslashes(htmlentities($login, ENT_QUOTES, "UTF-8"));
    $haslo = addslashes(htmlentities($haslo, ENT_QUOTES, "UTF-8"));
    
    if($wynik = @$polaczenie->query(sprintf("SELECT * FROM users WHERE login='%s' AND haslo='%s'", 
                                            mysqli_real_escape_string($polaczenie, $login), 
                                            mysqli_real_escape_string($polaczenie, $haslo))))
    {
        if($wynik->num_rows == 1)
        {
            $_SESSION['zalogowany'] = true;
            
            $wiersz = $wynik->fetch_assoc();
            
            $_SESSION['id'] = $wiersz['ID'];
            $_SESSION['login'] = $wiersz['login'];
            $_SESSION['haslo'] = $wiersz['haslo'];
            $_SESSION['mail'] = $wiersz['mail'];
            
            unset($_SESSION['blad']);
            $wynik->free();
            header('Location: strona.php');
        }
        else
        {
            $_SESSION['blad'] = "<br /><h3 style='color: red;'>Błędny login lub hasło</h3>";
            header('Location: index.php');
        }
    }
    
    $polaczenie->close();
}

?>