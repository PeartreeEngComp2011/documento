<form action="processar_documento.php" method="post" enctype="multipart/form-data">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br><br>

    <label for="data_posse">Data de Posse:</label>
    <input type="date" name="data_posse" required><br><br>

    <label for="documento">Documento Pessoal:</label>
    <input type="file" name="documento" required><br><br>

    <input type="submit" name="enviar" value="Enviar">
</form>