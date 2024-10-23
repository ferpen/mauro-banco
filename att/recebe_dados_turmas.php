<?php

$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "INSERT INTO `turmas` (`id`, `nome`) VALUES (NULL, :nometurma);";

    try {
        $comando = $conexao->prepare($codigoSQL);

        $resultado = $comando->execute(array('nometurma' => $_GET['nome']));

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
?>