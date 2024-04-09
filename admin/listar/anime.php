<h1 class="text-center"> Listagem Dos Animes</h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome da categoria</td>
                    <td>Duração média de Cada EP</td>
                    <td>Ano do Lançamento</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM anime";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) { 
                ?>
                <tr>
                    <td><?= $dados->id?></td>
                    <td><?= $dados->nome?></td>
                    <td><?= $dados->duracao?></td>
                    <td><?= $dados->ano_lancamento?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
