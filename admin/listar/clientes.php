<h1 class="text-center"> Todas os Clientes</h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do cliente</td>
                    <td>CPF do cliente</td>
                    <td>E-mail do cliente</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM cliente";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) { 
                ?>
                <tr>
                    <td><?= $dados->id?></td>
                    <td><?= $dados->nome?></td>
                    <td><?= $dados->email?></td>
                    <td><?= $dados->cpf?></td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>