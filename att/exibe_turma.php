<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
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
        $conexao = null;
?>
<form action="exibe_turma.php">
<label for="turma">Selecione a turma:</label>
<select name="turma" id="turma">
<?php
    while ($linha=$comando->fetch()){
        echo "<option value={$linha['id']}>{$linha['nome']}</option>";
    }
?>
</select>
<input type="submit"><br><br>
</form>



<?php
if(isset($_GET['turma'])){
$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
$codigoSQL =  "SELECT * FROM `alunos` WHERE `id_turma` = :turma";
$comando = $conexao->prepare($codigoSQL);
$resultado= $comando->execute(array('turma'=> $_GET['turma']));

?>
 <table border="1">
        <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Nota</th> 
        </tr>
        <?php
while($linha=$comando->fetch()){
?>
<tr>
<td><?php echo $linha['id']; ?></td>
<td><?php echo $linha['nome']; ?></td>
<td><?php echo "<a href='mostra_nota.php?aluno={$linha['id']}'>notas</a>"; ?></td>
</tr>
<?php
}
echo "</table>";


$conexao = null;
}
?>
</body>
</html>