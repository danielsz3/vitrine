<?php

//1. pegar o valor do nome e guardar em uma varíavel
$nome = $_POST["nome"] ?? NULL;
$id = $_POST["id"] ?? NULL;

//2. validar se o nome estiver vazio lançar msg de erro
if (empty($nome)) {
    mensagemErro("Campo nome em branco");
}

if (empty($email)) {
    mensagemErro("Campo nome em branco");
}

if (empty($cpf)) {
    mensagemErro("Campo nome em branco");
}

//3. cria a consulta no BD, verificando se o nome já existe

$sql = "select id from cliente where email = :email OR cpf = cpf"; //não passar direto $nome por segurança para não ocorrer "sql injection"
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":email", $email);
$consulta->bindParam(":cpf", $cpf); //cuida para não ocorrer sql injection 
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

//4. se tiver o cadastro, enviar msg de erro
if (!empty($dados->id)) {
    mensagemErro("Já existe um cliente cadastrado com esse nome");
}

//5. faz o insert para gravar na tabela
if (empty($id)) {
    $sql = "insert into cliente (nome, email, cpf) values (:nome, :email, cpf)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->execute();
} else {
    $sql = "update cliente set nome = :nome, email = :email, cpf = :cpf where id = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":id", $id);
    $consulta->bindParam(":cpf", $cpf);
    $consulta->bindParam(":email", $email);

    $consulta->execute();
}

//6. redireciona o usuário para a listagem de clientes
echo "<script> location.href = 'listar/clientes'</script>";
exit;
