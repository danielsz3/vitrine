<?php 

$cep = NULL;

function get_endereco($cep){
    // formatar o cep removendo caracteres nao numericos
    $cep = preg_replace("/[^0-9]/", "", $cep);
    $url = file_get_contents("http://viacep.com.br/ws/$cep/json/");
    $xml = json_decode($url,true);
    return $xml;
    }
    ?>
<meta charset="UTF-8">
<form action="" method="post">
    
</form>
<?php if($_POST['cep']){ ?>


<?php 
    }


if (!empty($id)) {

//precisa buscar a categoria que tenha o id na url
//salvar em uma variável nome

$sql = "select * from categoria where id = :id";
$consulta = $pdo -> prepare ($sql);
$consulta -> bindParam (':id', $id);
$consulta -> execute ();

$dados = $consulta -> fetch (PDO::FETCH_OBJ);

$id = $dados -> id ?? NULL;
$cep = $dados -> cep ?? NULL;

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

        <form action="" method="post">
            <input type="text" name="cep">
            <button type="submit">Pesquisar Endereço</button>
        </form>
        <?php if($_POST['cep']){ ?>
        <h2>CEP Encontrado: </h2>
        <p>
            <?php $endereco = get_endereco($_POST['cep']); ?>
            <b>CEP: </b> <?php echo $endereco['cep']; ?><br>
            <b>Logradouro: </b> <?php echo $endereco['logradouro']; ?><br>
            <b>Bairro: </b> <?php echo $endereco['bairro']; ?><br>
            <b>Localidade: </b> <?php echo $endereco['localidade']; ?><br>
            <b>UF: </b> <?php echo $endereco['uf']; ?><br>
        </p>
        <?php 
    }
    ?>
        <form action="salvar/cep" method="POST">
            <label for="id"> ID da Categoria</label>
            <input type="text" name="id" id="id" class="form-control" value="<?=$id?>" readonly>


            <label for="nome">Nome da Categoria:</label>
            <input type="text" name="nome" id="nome" class="form-control" required value="<?=$cep?>">

            <br>

            <button type="submit" class="btn btn-success">Salvar Dados
            </button>
        </form>
    </div>
</div>
