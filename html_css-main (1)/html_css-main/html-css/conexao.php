<?php
$servername = "127.0.0.1";
$username = "root"; 
$password = "32568917Mn";    
$dbname = "sistema_cadastro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
