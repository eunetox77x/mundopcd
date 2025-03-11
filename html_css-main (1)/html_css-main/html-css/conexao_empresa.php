<?php
// Conexão com o banco de dados
$servername = "127.0.0.1";
$username = "root";
$password = "32568917Mn";
$dbname = "sistema_cadastro";

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $empresa_nome = $_POST['empresa-nome'];
    $cnpj = $_POST['cnpj'];
    $segmento = $_POST['segmento'];
    $endereco = $_POST['endereco'];
    $site = $_POST['site'];
    $responsavel_nome = $_POST['responsavel-nome'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $politicas_inclusao = $_POST['politicas-inclusao'];
    $vagas_pcd = $_POST['vagas-pcd'];
    $numero_vagas = $_POST['numero-vagas'];
    $descricao_vagas = $_POST['descricao-vagas'];
    $beneficios = $_POST['beneficios'];

    // SQL para inserir os dados na tabela empresas_parceiras
    $sql = "INSERT INTO empresas_parceiras (empresa_nome, cnpj, segmento, endereco, site, responsavel_nome, cargo, email, telefone, politicas_inclusao, vagas_pcd, numero_vagas, descricao_vagas, beneficios)
            VALUES ('$empresa_nome', '$cnpj', '$segmento', '$endereco', '$site', '$responsavel_nome', '$cargo', '$email', '$telefone', '$politicas_inclusao', '$vagas_pcd', '$numero_vagas', '$descricao_vagas', '$beneficios')";

    // Verifica se a inserção foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página de sucesso
        header("Location: sucesso_cadastro.html");
        exit(); // Encerra o script após o redirecionamento
    } else {
        // Exibe mensagem de erro se a inserção falhar
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
