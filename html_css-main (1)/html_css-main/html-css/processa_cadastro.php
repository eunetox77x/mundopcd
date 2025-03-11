<?php
// Inclui o arquivo de conexão
require 'conexao_empresa.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome_empresa = $_POST['empresa-nome'];
    $cnpj = $_POST['cnpj'];
    $segmento = $_POST['segmento'];
    $endereco = $_POST['endereco'];
    $site_empresa = $_POST['site'];
    $nome_responsavel = $_POST['responsavel-nome'];
    $cargo_responsavel = $_POST['cargo'];
    $email_contato = $_POST['email'];
    $telefone_contato = $_POST['telefone'];
    $politicas_inclusao = $_POST['politicas-inclusao'];
    $vagas_pcd = $_POST['vagas-pcd'];
    $numero_vagas = $_POST['numero-vagas'];
    $descricao_vagas = $_POST['descricao-vagas'];
    $beneficios = $_POST['beneficios'];
    $compromisso_inclusao = isset($_POST['compromisso']) ? 1 : 0; // Checkbox
    $termos = isset($_POST['termos']) ? 1 : 0; // Checkbox

    // Insere os dados na tabela
    $sql = "INSERT INTO empresas_parceiras (nome_empresa, cnpj, segmento, endereco, site_empresa, nome_responsavel, cargo_responsavel, email_contato, telefone_contato, politicas_inclusao, vagas_pcd, numero_vagas, descricao_vagas, beneficios, compromisso_inclusao, termos) 
            VALUES (:nome_empresa, :cnpj, :segmento, :endereco, :site_empresa, :nome_responsavel, :cargo_responsavel, :email_contato, :telefone_contato, :politicas_inclusao, :vagas_pcd, :numero_vagas, :descricao_vagas, :beneficios, :compromisso_inclusao, :termos)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Liga os valores aos parâmetros
    $stmt->bindParam(':nome_empresa', $nome_empresa);
    $stmt->bindParam(':cnpj', $cnpj);
    $stmt->bindParam(':segmento', $segmento);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':site_empresa', $site_empresa);
    $stmt->bindParam(':nome_responsavel', $nome_responsavel);
    $stmt->bindParam(':cargo_responsavel', $cargo_responsavel);
    $stmt->bindParam(':email_contato', $email_contato);
    $stmt->bindParam(':telefone_contato', $telefone_contato);
    $stmt->bindParam(':politicas_inclusao', $politicas_inclusao);
    $stmt->bindParam(':vagas_pcd', $vagas_pcd);
    $stmt->bindParam(':numero_vagas', $numero_vagas);
    $stmt->bindParam(':descricao_vagas', $descricao_vagas);
    $stmt->bindParam(':beneficios', $beneficios);
    $stmt->bindParam(':compromisso_inclusao', $compromisso_inclusao, PDO::PARAM_BOOL);
    $stmt->bindParam(':termos', $termos, PDO::PARAM_BOOL);

    // Executa a declaração SQL
    if ($stmt->execute()) {
        echo "Empresa cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar empresa.";
    }
}
?>
