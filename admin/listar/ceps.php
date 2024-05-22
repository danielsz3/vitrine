<h1 class="text-center"> Endereços cadastrados </h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>CEP</td>
                    <td>Número</td>
                    <td>Complemento</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM cep";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) { 
                ?>
                <tr>
                    <td><?= $dados->id?></td>
                    <td><?= $dados->cep?></td>
                    <td><?= $dados->logradouro?></td>
                    <td><?= $dados->bairro?></td>
                    <td><?= $dados->numero?></td>
                    <td><?= $dados->complemento?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>