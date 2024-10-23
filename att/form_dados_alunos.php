<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Aluno</title>
</head>
<body>
<?php

$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
$codigoSQL =  "SELECT `id`, `nome` FROM `turmas`";
        $comando = $conexao->prepare($codigoSQL);
        $resultado= $comando->execute();
?>

<form action="recebe_dados_alunos.php">
	<label for="nome">Nome:</label>
	<input type="text" name="nome"><br><br>
    <label for="turma">Turma:</label>

    <select name="turma" id="turma">
        <?php
        while ($linha=$comando->fetch()){
            echo "<option value={$linha['id']}>{$linha['nome']}</option>";
        }
        ?>
    </select>
    <br><br>
	<input type="submit">
    </form>
    <?php
           $conexao = null;
    ?>
</body>
</html>