<?php

//gravar o login e a senha na sessão

// TODO verificar se o metódo POST está preenchido com o login e senha.
// TODO Caso esteja preenchido, buscar no banco de dadosDoBanco o login.
// TODO Validar se não existir o id no banco, mostrar mensagem de usuário não encontrado.
// TODO Ir para a página home caso haja usuário não encontrado. 
// FIXME estude, seu arrombadinho 


if ($_POST) {
    $login = $_POST["login"] ?? null;
    $senha = $_POST["senha"] ?? null;

    echo "chegou aqui"; //teste se o if está sendo validado

    $sql = "select id, nome, login, senha
            from usuario
            where login = :login AND ativo = 's'
            ";

    $consulta = $pdo->prepare($sql);

    $consulta-> bindParam(":login", $login);

    $consulta-> execute();

    $dadosDoBanco = $consulta->fetch(PDO::FETCH_OBJ);

    var_dump($dadosDoBanco); //

    $idNaoEncontrado = !isset($dadosDoBanco->id);

    $senhaIncorreta = !password_verify($senha, $dadosDoBanco->senha);

    if ($idNaoEncontrado) {
        mensagemErro('Usuário não encontrado ou inativo');
    } else if ($senhaIncorreta) {
        mensagemErro('Senha incorreta, paiaço');
    }

    $_SESSION["usuario"] = [
        "id" => $dadosDoBanco -> id,
        "nome" => $dadosDoBanco -> nome,
        "login" => $dadosDoBanco -> login,
    ];

    echo "<script> location.href ='pages/home'</script>";
    exit;
}


?>

<div class="login">
    <h1 class="text-center"> Sistemas 3ºA </h1>

    <form method="post">

        <label for="login">Usuário:</label>

        <input name="login" id="login" type="text" class="form-control" placeholder="Digite seu login">

        <label for="senha">Senha:</label>

        <input name="senha" id="senha" type="password" class="form-control" required placeholder="Preencha com a sua senha">

        <br>

        <button type="submit" class="btn btn-sucess w-100"> Acessar</button>
    </form>

</div>

