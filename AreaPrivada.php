<?php
session_start();
if(!isset($_SESSION['id_usuario'])) { //Verificar se a sessão existe. Se não existir, voltar para a página inicial.
    header("location:index.php");
    exit;
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Área de Membros</title>
        <link rel="stylesheet" href="CSS/estilo.css">
    </head>
    
    <body>
        <div id="corpo">
            <h1>Bem vindo!</h1>
            <a href="sair.php"><button class="btn"> Sair </button></a>
        </div>
    </body>
</html>