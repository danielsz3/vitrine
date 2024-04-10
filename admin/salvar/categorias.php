<h1>ok</h1>

<?php

//1. pegar o valor do nome e guardar em uma varíavel
$nome = $_POST["nome"] ?? null ;

//2. validar se o nome estiver vazio lançar msg de erro
if(empty($nome)) {
    mensagemErro("Campo nome em branco");
}

//3. cria a consulta no BD, verificando se o nome já existe
$sql = "Select id from categoria where nome = :nome"; //não passar direto $nome por segurança para não ocorrer "sql injection"
$consulta = $pdo -> prepare ($sql);
$consulta -> bindParam (":nome", $nome); //cuida para não ocorrer sql injection 
$consulta -> execute();
$dados = $consulta -> fetch (PDO::FETCH_OBJ);

//4. se tiver o cadastro, enviar msg de erro
if (!empty($dados -> id)) {
    mensagemErro("Já existe uma categoria cadastrada com esse nome");
}

//5. faz o insert para gravar na tabela
$sql = "insert into categoria (nome) values (:nome)";
$consulta = $pdo -> prepare($sql);
$consulta -> bindParam (":nome", $nome);
$consulta -> execute();

//6. redireciona o usuário para a listagem de categorias
echo "<script> location.href = 'listar/categorias'</script>";
exit;
