<?php 
    
    $complemento = NULL;
    

    if (!empty($id)) {

        //precisa buscar a Endereço que tenha o id na url
        //salvar em uma variável cep

        $sql = "select * from cep where id = :id";
        $consulta = $pdo -> prepare ($sql);
        $consulta -> bindParam (':id', $id);
        $consulta -> execute ();

        $dados = $consulta -> fetch (PDO::FETCH_OBJ);

        $id = $dados -> id ?? NULL;
        $cep = $dados -> cep ?? NULL;
        $nunero = $dados -> numero ?? NULL;
        $complemento = $dados -> complemento ?? NULL;


    }

?>


<div class="card">
    <div class="card-header">
        <h2>Cadastro de Endereços</h2>

        <div class="float-right">
            <a href="listar/cep" class="btn btn-success">
                Listar Endereços
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="salvar/cep" method="POST">
            <label for="id"> ID da Endereço</label>
            <input
                type="text"
                name="id"
                id="id"
                class="form-control"
                value="<?=$id?>"
                readonly
                >
                

            <label for="cep">CEP do Endereço:</label>
            <input
                type="number"
                name="cep"
                id="cep"
                class="form-control"
                required
                value="<?=$cep?>" >

            <br>

            <label for="cep">Número:</label>
            <input
                type="number"
                name="numero"
                id="numero"
                class="form-control"
                required
                value="<?=$numero?>" >

            <br>

            <label for="cep">Complemento:</label>
            <input
                type="text"
                name="complemento"
                id="complemento"
                class="form-control"
                required    
                value="<?=$complemento?>" >

            <br>


            <button type="submit" class="btn btn-success">Salvar Dados
            </button>
        </form>
    </div>
</div>
