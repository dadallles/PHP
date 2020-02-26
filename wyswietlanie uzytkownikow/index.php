<!doctype HTML>
<html land="pl">
    <head>
        <meta charset="utf-8" />
        <style type="text/css">
        table, h1
            {
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
        </style>
    </head>
    </body>
<?php

$polaczenie = @new mysqli("localhost", "root", "", "konta");

if ($polaczenie->connect_errno != 0)
{
    echo "Error: " . $polaczenie->conect_errno;
    exit();
}
else
{
            if ($liczba = @$polaczenie->query("SELECT id FROM users ORDER BY id DESC LIMIT 1"))
            {
                echo "<h1>Lista urzytkowników</h1>";
                $liczba1 = $liczba->fetch_assoc();
                $liczbaid = $liczba1['id'];
                $pliczbaid = 1;
echo <<<_END
<table border='1px' cellpadding='5px' style='border-collapse: collapse; font-size: 18px;'>
    <tr style='font-weight: bold;'>
        <td>ID</td>
        <td>login</td>
        <td>hasło</td>
        <td>mail</td>
        </tr>
_END;
                    while ($pliczbaid <= $liczbaid)
                    {
                        if (null !== ($nr = @$polaczenie->query("SELECT id, login, haslo, mail FROM users WHERE id = $pliczbaid")))
                        {
                            $nazwa = $nr->fetch_assoc();
                                if (isset($nazwa['login']))
                                {
                                    echo "<tr><td>";
                                    print_r($nazwa['id']);
                                    echo "</td><td>";
                                    print_r($nazwa['login']);
                                    echo "</td><td>";
                                    print_r($nazwa['haslo']);
                                    echo "</td><td>";
                                    print_r($nazwa['mail']);
                                    echo "</td></tr>";
                                }
                        }
                        $pliczbaid++;
                    }
                echo "</table>";
            }
    $polaczenie->close();
}

?>
    </body>
</html>