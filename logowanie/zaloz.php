<?php
session_start();
?>


<doctype html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
        <meta charset="utf-8" />
        <script type="text/javascript">
        
            function kod()
            {
                var kod = Math.floor(Math.random() * 1000000);
                document.getElementById("kod").innerHTML = kod;
                document.getElementById("hid").value = kod;
            }
        
        </script>
        <title>Załóż konto!</title>
    </head>
    <body onload="kod(); ">
        <h1>Załóż konto!</h1>
        <form action="zalozkonto.php" method="post">
            Login: <br />
            <input type="text" name="login" /><br />
            Hasło: <br />
            <input type="password" name="pass1" /><br />
            Powtórz hasło: <br />
            <input type="password" name="pass2"/><br />
            Podaj adres mailowy: <br />
            <input type="text" name="mail" id="mail" /><br />
            Przepisz kod: 
            <div id="kod"></div><br />
            <input type="text" name="kod" /><br />
            <input type="hidden" value="" id="hid" name="hid" /><br />
            <div id="error" style="color: red; ">
            <?php
            if(isset($_SESSION['blad'])) 
                {
                 echo $_SESSION['blad'];
                }
            unset($_SESSION['blad']);
            ?>
            </div>
            <input type="submit" value="Zarejestruj!" onclick="spr(); "/>
        </form>
        <p><a href="index.php">Strona główna</a></p>
    </body>
</html>




