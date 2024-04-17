<?php 
    
    $nome = NULL;
    $email = NULL;
    $cpf = NULL;


    if (!empty($id)) {

        //precisa buscar a cliente que tenha o id na url
        //salvar em uma variável nome

        $sql = "select * from cliente where id = :id";
        $consulta = $pdo -> prepare ($sql);
        $consulta -> bindParam (':id', $id);
        $consulta -> execute ();

        $dados = $consulta -> fetch (PDO::FETCH_OBJ);

        $id = $dados -> id ?? NULL;
        $nome = $dados -> nome ?? NULL;
        $cpf = $dados -> email ?? NULL;
        $email = $dados -> cpf ?? NULL;


 
    }

?>


<div class="card">
    <div class="card-header">
        <h2>Cadastro de clientes</h2>

        <div class="float-right">
            <a href="listar/clientes" class="btn btn-success">
                Listar clientes
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="salvar/clientes" method="POST">
            <label for="id"> ID da cliente</label>
            <input
                type="text"
                name="id"
                id="id"
                class="form-control"
                value="<?=$id?>"
                readonly
                >
                

            <label for="nome">Nome da cliente:</label>
            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control"
                required
                value="<?=$nome?>" >

            <br>
            <label for="nome">CPF do cliente:</label>
            <input
                type="text"
                name="cpf"
                id="cpf"
                class="form-control"
                required
                value="<?=$cpf?>" >

            <br>
            <label for="nome">E-mail do cliente:</label>
            <input
                type="mail"
                name="email"
                id="email"
                class="form-control"
                required
                value="<?=$email?>" >

            <br>


            <button type="submit" class="btn btn-success">Salvar Dados
            </button>
        </form>
    </div>
</div>
