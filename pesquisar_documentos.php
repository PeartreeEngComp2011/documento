<?php
// Conecte-se ao banco de dados
$conn = new mysqli("localhost", "root", "", "documento");

// Verifique a conexão
if ($conn->connect_error) 
{
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if (isset($_POST['pesquisar'])) 
{
    $nome_pesquisa = $_POST['nome_pesquisa'];
    $data_posse_pesquisa = $_POST['data_posse_pesquisa'];

    // Construa a consulta SQL com base nos critérios de pesquisa
    $sql = "SELECT * FROM documentos WHERE 1";

    if (!empty($nome_pesquisa)) 
    {
        $sql .= " AND nome LIKE '%$nome_pesquisa%'";
    }

    if (!empty($data_posse_pesquisa)) 
    {
        $sql .= " AND data_posse = '$data_posse_pesquisa'";
    }

    // Execute a consulta
    $result = $conn->query($sql);

    // Verifique se há resultados
    if ($result) 
    {
        if ($result->num_rows > 0) 
        {
            echo "<h2>Resultados da Pesquisa:</h2>";
            while ($row = $result->fetch_assoc()) 
            {
                echo "Nome: " . $row['nome'] . "<br>";
                echo "Data de Posse: " . $row['data_posse'] . "<br>";

                // Link para baixar o documento
                echo "<a href='caminho/para/os/documentos/no/servidor/" . $row['nome_do_documento'] . "' download>Baixar Documento</a>";
                echo "<hr>";
            }
        } else 
        {
            echo "Nenhum documento encontrado com os critérios de pesquisa informados.";
        }
    } else 
    {
        echo "Erro na consulta: " . $conn->error;
    }

    // Feche o resultado
    $result->close();
}

// Feche a conexão
$conn->close();
?>