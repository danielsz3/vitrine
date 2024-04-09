<h1 class="text-center"> Todas as categorias</h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome da categoria</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM categoria";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) { 
                ?>
                <tr>
                    <td><?= $dados->id?></td>
                    <td><?= $dados->nome?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
