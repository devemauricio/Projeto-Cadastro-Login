<?php
require_once 'CLASSES/usuarios.php';
$u = new Usuario();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Projeto Login</title>
        <link rel="stylesheet" href="CSS/estilo.css">
    </head>
    
    <body>
        <div id="corpo-form">
            <h1>Entrar</h1>
            <form method="POST">
                <input type="text" placeholder="Email/Usuario" name="usuario">
                <input type="password" placeholder="Senha" name="senha">
                <input type="submit" value="Acessar" name="submit">
                <a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
            </form>
        </div>
        
        <?php
        if (isset($_POST['submit'])) {
            $u = new Usuario();
            $usuario = addslashes($_POST['usuario']);
            $senha = addslashes($_POST['senha']);
            // verificar se está preenchido
            if(!empty($usuario) && !empty($senha)) {
                $u->conectar("projeto_login", "localhost", "root", "");
                if($u->msgErro == "") {
                    if($u->logar($usuario, $senha)) {
                        header("location:AreaPrivada.php");
                    } else {
                        echo '<script language="javascript">';
                        echo 'alert("Usuário e/ou senha estão incorretos!")';
                        echo '</script>';
                    }
                } else {
                    echo '<script language="javascript">';
                    echo 'alert("Erro:".$u->msgErro)';
                    echo '</script>';
                    
                }
            } else {
                echo '<script language="javascript">';
                echo 'alert("Preencha todos os campos!")';
                echo '</script>';
            }
        }
        ?>
    </body>
</html>

<!--
CREATE DATABASE projeto_login;
USE projeto_login;
CREATE TABLE usuarios(
	id_usuario int AUTO_INCREMENT PRIMARY KEY,
    nome varchar(30),
    username varchar(30),
    email varchar(40),
    senha varchar(32)
);
CREATE TABLE alunos (
    id_aluno int AUTO_INCREMENT PRIMARY KEY,
	nome varchar(30),
    data_nasc varchar(8)
);
-->