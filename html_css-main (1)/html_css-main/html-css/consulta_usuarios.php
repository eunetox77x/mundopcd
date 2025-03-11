<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Consulta SQL para selecionar todos os usuários
$sql = "SELECT id, nome_completo, data_nascimento, email, data_registro FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos usuários
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome Completo</th><th>Data de Nascimento</th><th>Email</th><th>Data de Registro</th></tr>";
    
    // Loop pelos resultados da consulta
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nome_completo"] . "</td>";
        echo "<td>" . $row["data_nascimento"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["data_registro"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}

$conn->close(); // Fecha a conexão
?>
