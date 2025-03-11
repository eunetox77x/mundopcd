<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $tipo_deficiencia = $_POST['deficiencia'];
    $cargo = $_POST['cargo'];
    $experiencia = $_POST['experiencia'];
    $motivacao = $_POST['motivacao'];
    $disponibilidade = $_POST['disponibilidade'];

    // Tratamento do upload do laudo PDF
    if (isset($_FILES['laudo']) && $_FILES['laudo']['error'] == 0) {
        $arquivo_tmp = $_FILES['laudo']['tmp_name'];
        $nome_arquivo = $_FILES['laudo']['name'];
        $destino = 'uploads/' . $nome_arquivo;

        // Verifica se o arquivo é um PDF
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        if ($extensao != 'pdf') {
            die("O arquivo deve ser um PDF.");
        }

        // Move o arquivo para a pasta 'uploads'
        if (move_uploaded_file($arquivo_tmp, $destino)) {
            // Sucesso no upload do arquivo
        } else {
            die("Erro ao enviar o laudo.");
        }
    } else {
        die("Erro no envio do laudo.");
    }

    // Prepara a consulta SQL para inserir os dados na tabela (supondo que o usuário já está cadastrado na Etapa 1)
    $sql = "UPDATE usuarios SET tipo_deficiencia=?, laudo_pdf=?, cargo=?, experiencia_trabalho=?, motivacao=?, disponibilidade=? WHERE id=?";

    // Substitua pelo ID correto do usuário, que deve ser recuperado de uma sessão ou outra forma de identificação.
    // Por simplicidade, usarei $usuario_id como placeholder aqui.
    $usuario_id = 1; // Este ID deve vir da sessão ou da base de dados da Etapa 1

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $tipo_deficiencia, $nome_arquivo, $cargo, $experiencia, $motivacao, $disponibilidade, $usuario_id);

    if ($stmt->execute()) {
        echo "Cadastro da Etapa 2 concluído com sucesso!";
        header("Location: pg_cadastro_pt3.html");
        exit;
    } else {
        echo "Erro ao salvar os dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
