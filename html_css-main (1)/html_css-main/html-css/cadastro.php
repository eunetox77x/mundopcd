<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_completo = $_POST['username'];
    $data_nascimento = $_POST['dt_nascimento'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirm_senha = $_POST['confirm_password'];

    // Verifica se as senhas coincidem
    if ($senha !== $confirm_senha) {
        echo "As senhas não coincidem!";
    } else {
        // Hash da senha para segurança
        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

        // Prepara a consulta SQL para inserir os dados
        $sql = "INSERT INTO usuarios (nome_completo, data_nascimento, email, senha) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome_completo, $data_nascimento, $email, $senha_hashed);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            header("Location: pg_cadastro_pt2.html");
            exit;
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
