<?php
require_once 'CLASSES/usuarios.php';
require_once 'CLASSES/alunos.php';
?>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Projeto Login</title>
        <link rel="stylesheet" href="CSS/estilo.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
        <script>
            $(document).ready(function(){
                $("#corpo-usuario").hide();
                $("#corpo-aluno").hide();
                
                $("#usuario").click(function(){
                    $("#corpo-aluno").animate({
                        height: 'hide'
                    });
                    $("#corpo-usuario").animate({
                        height: 'show'
                    });
                });
                
                $("#aluno").click(function(){
                    $("#corpo-usuario").animate({
                        height: 'hide'
                    });
                    $("#corpo-aluno").animate({
                        height: 'show'
                    });
                 });
            });
        </script>
    </head>
    
    <body>
        <div id="corpo">
        <div id="cabecalho">
            <h1>Cadastrar</h1>
            <div class="blocks">
                <button id="aluno" class=btn>Aluno</button>
                <button id="usuario" class="btn">Usuário</button>
            </div>
            <a href="index.php">Já possui conta? <strong>Entrar!</strong></a>
        </div>
            <div id="corpo-usuario">
                <div id="form-cad-usuario">
                    <form method="POST">
                        <input type="text" name="nome_usr" placeholder="Nome completo" maxlength="30">
                        <input type="text" name="usuario" placeholder="Nome de Usuário" maxlength="30">
                        <input type="email" name="email" placeholder="Email" maxlength="40">
                        <input type="password" name="senha" placeholder="Senha" maxlength="15">
                        <input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15">                
                        <input type="submit" name="submit_usr" value="Cadastrar">

                    </form>
                </div>
            </div>
            <div id="corpo-aluno">
                <div id="form-cad-aluno">
                    <form method="POST">
                        <input type="text" name="nome_al" placeholder="Nome completo" maxlength="30">
                        <input type="text" name="aniversario" placeholder="Data de aniversário" maxlength="10">
                        <input type="submit" name="submit_al" value="Cadastrar">

                    </form>
                </div>
            </div>
        </div>

        <?php
        // verificar se clicou no botão...
        if (isset($_POST['submit_usr'])) { // ...de envio de dados de usuario
            $u = new Usuario();
            $nome = addslashes($_POST['nome_usr']);
            $usuario = addslashes($_POST['usuario']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confSenha =addslashes($_POST['confSenha']);
            // verificar se está preenchido
            if(!empty($nome) && !empty($usuario) && !empty($email) && !empty($senha) && !empty($confSenha)) {
                $u->conectar("projeto_login", "localhost", "root", "");
                if($u->msgErro == "") { // se está tudo ok
                    if($senha == $confSenha) {
                        if($u->cadastrar($nome, $usuario, $email, $senha)) {
                            echo '<script language="javascript">';
                            echo 'alert("Cadastrado com Sucesso! Acesse para entrar!")';
                            echo '</script>';
                        } else {
                            echo '<script language="javascript">';
                            echo 'alert("Email já cadastrado!")';
                            echo '</script>';
                        }
                    } else {
                        echo '<script language="javascript">';
                        echo 'alert("Senha e Confirmar Senha não correspondem!")';
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
        if (isset($_POST['submit_al'])) { //...de envio de dados de aluno
            $a = new Aluno();
            $nome = addslashes($_POST['nome_al']);
            $aniversario = addslashes($_POST['aniversario']);
            
            if(!empty($nome) && !empty($aniversario)) {
                $a->conectar("projeto_login", "localhost", "root", "");
                if($a->msgErro == "") { // se está tudo ok
                    if($a->cadastrar($nome, $aniversario)) {
                        echo '<script language="javascript">';
                        echo 'alert("Cadastrado com Sucesso! Acesse para entrar!")';
                        echo '</script>';
                    } else {
                        echo '<script language="javascript">';
                        echo 'alert("Email já cadastrado!")';
                        echo '</script>';
                    }
                } else {
                    echo '<script language="javascript">';
                    echo 'alert("Erro:".$a->msgErro)';
                    echo '</script>';
                    
                }
            }
        }
        ?>

    </body>
</html>
