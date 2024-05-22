<?php

$cep = NULL;
$numero = NULL;

function get_foi($cep)
{
    $cep = preg_replace("/[^0-9]/", "", $cep);
    $url = "http://viacep.com.br/ws/$cep/json/";

    // Função para tratar erros como exceções
    set_error_handler(function ($message) {
        throw new Exception($message);
    });

    try {

        $jason = file_get_contents($url);
        $foi = json_decode($jason, true);

        if (isset($foi['erro'])) {
            return NULL;
        }

        restore_error_handler();

        return $foi;

    } catch (Exception) {
        restore_error_handler();
        
        return NULL;
    }
}

$foi = NULL;

if ($_POST['cep']) {
    $foi = get_foi($_POST['cep']);

    if ($foi) {

        $logradouro = $foi['logradouro'] ?? '';
        $cep = $foi['cep'] ?? '';
        $bairro = $foi['bairro'] ?? '';
        $uf = $foi['uf'] ?? '';
        $localidade = $foi['localidade'] ?? '';
    
        preg_replace('/-(?!>)/', '', '00000-001->22222-222');

        $sql = "INSERT INTO cep ( 
            cep, logradouro, bairro, localidade, estado, numero)
            VALUES (:cep, :logradouro, :bairro, :localidade, :estado, :numero)";
        $consulta = $pdo->prepare($sql);

        $consulta->bindParam(':cep', $cep);
        $consulta->bindParam(':logradouro', $logradouro);
        $consulta->bindParam(':bairro', $bairro);
        $consulta->bindParam(':localidade', $localidade);
        $consulta->bindParam(':uf', $estado);
        $consulta->bindParam(':numero', $numero);

        $consulta->execute();

        preg_replace('/-(?!>)/', '', '00000-001->22222-222');

        $sql = "SELECT * FROM cep WHERE id = :id";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        $dados = NULL;

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

    }
    if ($dados) {
        $logradouro = $dados->logradouro;
        $bairro = $dados->bairro;
        $localidade = $dados->localidade;
        $estado = $dados->uf;

    } else {
        echo "CEP encontrado, mas registro não encontrado no banco de dados.";
    }
} else {
    echo "CEP inválido ou não encontrado.";
}

?>

<meta charset="utf-8">

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
            <input type="text" name="cep" id="numero" class="" placeholder="Digite o cep desejado:" required value="<?= $cep ?>">

            <br><br>

            <button type="submit" class="btn btn-success">Buscar CEP</button>

        </form>

        <?php if ($foi) { ?>

            <br> <br>

            <h2>CEP Encontrado: </h2>

            <p>
                <b>CEP: </b> <?php echo $foi['cep']; ?><br>
                <b>Logradouro: </b> <?php echo $foi['logradouro']; ?><br>
                <b>Bairro: </b> <?php echo $foi['bairro']; ?><br>
                <b>Localidade: </b> <?php echo $foi['localidade']; ?><br>
                <b>UF: </b> <?php echo $foi['uf']; ?><br>
            </p>

            <form action="" method="POST">

                <input type="text" name="cep" value="<?= $cep['cep'] ?>">
                <input type="text" name="logradouro" value="<?= $logradouro['logradouro'] ?>">
                <input type="text" name="bairro" value="<?= $bairro['bairro'] ?>">
                <input type="text" name="localidade" value="<?= $localidade['localidade'] ?>">
                <input type="text" name="uf" value="<?= $estado['uf'] ?>">
                <input type="number" name="numero" value="<?= $numero ?>
                " placeholder="Digite o número do local" required><br>

                <br><br>

                
            </form>
        <?php
        }
        ?>
    </div>
</div>