<?php
$nome= "";
$email= "";
$telefone= "";
$mensagem= "";
$tipoMensagem= "";

$db_url = getenv("DATABASE_URL"); 
if (!$db_url) { 
    die("Erro: variável DATABASE_URL não encontrada.");

}
$conn = pg_connect($db_url);

if (!$conn) {
    die("Erro ao conectar no banco de dados");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");

    if ($nome === "" || $email === "" || $telefone === "") {
        $mensagem = "Preencha todos os campos.";
        $tipoMensagem = "erro";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "Digite um e-mail válido.";
        $tipoMensagem = "erro";
    } else{
        $query = "INSERT INTO usuarios (nome, email, telefone) VALUES ($1, $2, $3)";
        $result = pg_query_params($conn, $query, [$nome, $email, $telefone]);

        if($result) {
           $mensagem = "Usuário cadastrado com sucesso no banco de dados.";
           $tipoMensagem = "sucesso";

           $nome = "";
           $email = "";
           $telefone = "";

        }else{
            $mensagem = "Erro ao salvar no banco de dados.";
            $tipoMensagem = "erro";

        }
    }
}
$queryLista = "SELECT id, nome, email, telefone FROM usuarios ORDER BY id DESC";
$resultLista = pg_query($conn, $queryLista);
?> 

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
