<?php

session_start();

$login = $_POST['login'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$mail = $_POST['mail'];
$kod = $_POST['kod'];
$hid = $_POST['hid'];

$_SESSION['blad'] = "";

if(empty($login)) $_SESSION['blad'] = $_SESSION['blad']."Brak loginu! <br />";
if(empty($pass1 || $pass2)) $_SESSION['blad'] = $_SESSION['blad']."Brak hasła! <br />";
if(empty($mail)) $_SESSION['blad'] = $_SESSION['blad']."Brak maila! <br />";

if(isset($pass1) && isset($pass2) && $pass1 != $pass2) $_SESSION['blad'] = $_SESSION['blad']."Podałeś niezgodne hasła <br />";
if(isset($kod) && $kod != $hid) $_SESSION['blad'] = $_SESSION['blad']."Podałeś nieprawidłowy kod! <br />";

if(strlen($_SESSION['blad']) > 1) 
{
    header('Location: zaloz.php');
    exit();
}

require_once"dane.php";

$polaczenie = @new mysqli($host, $user, $pass, $database);

if($polaczenie->connect_errno != 0)
{
    echo "ERROR ".$polaczenie->connect_errno;
}
else
{
    $login = addslashes(htmlentities($login, ENT_QUOTES, "UTF-8"));
    $pass = addslashes(htmlentities($pass1, ENT_QUOTES, "UTF-8"));
    $mail = addslashes(htmlentities($mail, ENT_QUOTES, "UTF-8"));
    
    if($wynik = @$polaczenie->query(sprintf("SELECT * FROM users WHERE login='%s'",
                                           mysqli_real_escape_string($polaczenie, $login))))
    {
       if($wynik->num_rows != 0)
        {
            $_SESSION['blad'] = "Istnieje urzytkownik o takim loginie!";
            header('Location: zaloz.php');
            exit();
        }
    
        else
        {
            $dodanie = @$polaczenie->query(sprintf("INSERT INTO users (login, haslo, mail) VALUES ('%s', '%s', '%s')",
                                                  mysqli_real_escape_string($polaczenie, $login),
                                                  mysqli_real_escape_string($polaczenie, $pass),
                                                  mysqli_real_escape_string($polaczenie, $mail)));
            $_SESSION['blad'] = "Założyłeś konto o loginie ".$login.". Teraz możesz się zalogować!";
            header('Location: index.php');
        }
    }
        
    $polaczenie->close();
}

?>