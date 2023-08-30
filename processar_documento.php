<?php
// Conecte-se ao banco de dados
$conn = new mysqli("localhost", "root", "", "documento");

// Verifique a conexão
if ($conn->connect_error) 
{
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_POST['enviar'])) 
{
    $nome = $_POST['nome'];
    $data_posse = $_POST['data_posse'];
    $documento_tmp = $_FILES['documento']['tmp_name'];

    // Diretório de destino no servidor
    $diretorio_destino = 'C:/xampp/htdocs/DGP/documentos/';

    // Leitura do arquivo em binário
    $documento = addslashes(file_get_contents($documento_tmp));

    // Construa o caminho completo para o arquivo no servidor
    $caminho_arquivo = $diretorio_destino . $_FILES['documento']['name'];

    // Move o arquivo para o diretório de destino no servidor
    if (move_uploaded_file($documento_tmp, $caminho_arquivo)) 
    {
        // Inserir dados no banco de dados
        $sql = "INSERT INTO documentos (nome, data_posse, documento) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $data_posse, $documento);

        if ($stmt->execute()) 
        {
            echo 'Documento enviado e registrado com sucesso. Salvo em ' . $caminho_arquivo;
        } 
        else 
        {
            echo "Erro ao enviar o documento: " . $stmt->error;
        }

        $stmt->close();
    } 
    else 
    {
        echo 'Erro ao mover o arquivo para ' . $caminho_arquivo;
    }
}

// Feche a conexão
$conn->close();
?>