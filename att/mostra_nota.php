<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if(isset($_GET['aluno'])){
$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
$codigoSQL =  "SELECT `id_turma`, `valor` FROM `notas` WHERE `id_aluno` = :aluno";
$comando = $conexao->prepare($codigoSQL);
$resultado= $comando->execute(array('aluno'=> $_GET['aluno']));

?>
 <table border="1">
        <tr>
        <th>Turma</th>
        <th>Nota</th> 
        </tr>
        <?php
while($linha=$comando->fetch()){
?>
<tr>
<td><?php

$codigoSQL2 =  "SELECT `nome` FROM `turmas` WHERE `id` = {$linha['id_turma']}";
$comando2 = $conexao->prepare($codigoSQL2);
$resultado2= $comando2->execute(); 
$sala=$comando2->fetch();
echo "{$sala['nome']}";
?></td>
<td><?php echo $linha['valor']; ?></td>
</tr>
<?php
}
echo "</table>";


$conexao = null;
}
?>
<a href='exibe_turma.php'>voltar</a>
</body>
</html>
