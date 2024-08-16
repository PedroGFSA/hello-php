<?php

$host = 'localhost:3306';
$dbuser = 'root';
$dbpassword = 'root';
$dbname = 'visu_clientes';

$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
if ($conn) {
    // echo "Connection - successful </br>";
    migrate($conn);
} else {
    echo "Connection - failed </br>" . mysqli_connect_error();
}

// Executa as migrations
function migrate($conn)
{
    try {
        // Salvando a query na variável
        $create_clientes_table = file_get_contents("./migrations/001__create_clientes_table.sql");
        mysqli_query($conn, "$create_clientes_table");
    } catch (Exception $e) {
        // echo $e;
    }
}
?>