<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Atividade</title>
</head>
<body>
    <div class="input-group">
        <h2>Cadastro do Usuario</h2>
        <p>Preencha os dados abaixo</p>
        <form method= "post" action="">
            <input type="text" name="nome" placeholder="Digite seu nome" >
            <br>
            <br>
        <input type="text" name="email" placeholder="Digite seu e-mail" >
        <br>
        <br>
        <input type="text" name="telefone" placeholder="Digite seu telefone" >
        <br>
        <br>
        <button type="submit"> Confirmar</button>
    </form>
     <h2>Resultado</h2>
  <div id="resultado"> 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    echo "Dados recebidos: nome = " . htmlspecialchars($nome) . 
        ", E-mail = " . htmlspecialchars($email) .
        ", telefone = " . htmlspecialchars($telefone);

}

            ?>
         </div>
    </div>
</body>
</html>