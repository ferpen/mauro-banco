<?php
$confere=0;
$notinha=-30;
$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL1 =  "SELECT `id` FROM `turmas`";
$comando1 = $conexao->prepare($codigoSQL1);
$resultado1= $comando1->execute();

$codigoSQL2 =  "SELECT `id` FROM `alunos`";
$comando2 = $conexao->prepare($codigoSQL2);
$resultado2= $comando2->execute();

while ($linha=$comando1->fetch()){
if($linha['id']==$_GET['turma'])
$confere++;
}

while ($linha=$comando2->fetch()){
if($linha['id']==$_GET['aluno'])
$confere++;
}
$notinha = intval($_GET['nota']);
if($notinha > -1 && $notinha<11){
    $confere++;
}

if($confere!=3){
    echo "Favor inserir dados válidos!";
}
   
else{
$codigoSQL = "INSERT INTO `notas` (`id`, `valor`, `id_aluno`,`id_turma`) VALUES (NULL,:nota, :idaluno, :idturma);";

    try {
        $comando = $conexao->prepare($codigoSQL);

        $resultado = $comando->execute(array('nota'=>$_GET['nota'],'idaluno' => $_GET['aluno'], 'idturma' => $_GET['turma']));

        if($resultado){
            echo "Comando executado!";
        } else {
            echo "Erro ao executar o comando!";
        }
    } catch (Exception $e) {
        echo "Erro $e";
        }
        
        $conexao = null;

       // header("Location: .php");
    }
?>