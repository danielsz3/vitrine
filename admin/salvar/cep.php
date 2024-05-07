<?php

//1. pegar o valor do nome e guardar em uma varíavel
$cep = $_POST["cep"] ?? NULL;
$id = $_POST["id"] ?? NULL;

//2. validar se o cep estiver vazio lançar msg de erro
if (empty($cep)) {
    mensagemErro("Campo cep em branco");
}

//3. cria a consulta no BD, verificando se o cep já existe

$sql = "Select id from cep where cep = :cep"; //não passar direto $cep por segurança para não ocorrer "sql injection"
$consulta = $pdo->prepare($sql);
$consulta->bindParam(":cep", $cep); //cuida para não ocorrer sql injection 
$consulta->execute();
$dados = $consulta->fetch(PDO::FETCH_OBJ);

//4. se tiver o cadastro, enviar msg de erro
if (!empty($dados->id)) {
    mensagemErro("Já existe um endereço com esse CEP cadastrado");
}

//5. faz o insert para gravar na tabela
if (empty($id)) {
    $sql = "insert into cep (cep) values (:cep)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":cep", $cep);
    $consulta->execute();
} else {
    $sql = "update cep set cep = :cep where id = :id";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":cep", $cep);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
}

//6. redireciona o usuário para a listagem de ceps
echo "<script> location.href = 'listar/cep'</script>";
exit;
