<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $funcao_alem = $_POST['funcao-alem'];
    $trabalho_equipe = $_POST['trabalho-equipe'];
    $flexibilidade_horario = $_POST['flexibilidade-horario'];
    $desafios = $_POST['desafios'];

    // Tratamento do upload do currículo (PDF ou imagem)
    if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == 0) {
        $arquivo_tmp = $_FILES['curriculo']['tmp_name'];
        $nome_arquivo = $_FILES['curriculo']['name'];
        $destino = 'uploads/curriculos/' . $nome_arquivo;

        // Verifica a extensão do arquivo (PDF ou imagem)
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        if ($extensao != 'pdf' && !in_array($extensao, ['jpg', 'jpeg', 'png'])) {
            die("O arquivo deve ser um PDF ou uma imagem (JPG, JPEG, PNG).");
        }

        // Move o arquivo para a pasta 'uploads/curriculos'
        if (move_uploaded_file($arquivo_tmp, $destino)) {
            // Sucesso no upload do arquivo
        } else {
            die("Erro ao enviar o currículo.");
        }
    } else {
        die("Erro no envio do currículo.");
    }

    // Prepara a consulta SQL para atualizar os dados na tabela
    $sql = "UPDATE usuarios SET curriculo_pdf=?, funcao_alem=?, trabalho_equipe=?, flexibilidade_horario=?, desafios=? WHERE id=?";

    // Substitua pelo ID correto do usuário, que deve ser recuperado de uma sessão ou outra forma de identificação
    $usuario_id = 1; // Este ID deve vir da sessão ou de outra referência

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nome_arquivo, $funcao_alem, $trabalho_equipe, $flexibilidade_horario, $desafios, $usuario_id);

    if ($stmt->execute()) {
        echo "Cadastro concluído com sucesso!";
        // Redirecionar para uma página de confirmação ou outra página relevante
        header("Location: finalizacao_sucesso.php");
        exit;
    } else {
        echo "Erro ao salvar os dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
