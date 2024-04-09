<h1 class="text-center"> Listagem Produtos </h1>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Descrição</td>
                    <td>Valor</td>
                    <td>Imagem1</td>
                    <td>Imagem2</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM produto";

                $consulta = $pdo->prepare($sql);
                $consulta->execute();
                while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) { 
                ?>
                <tr>
                    <td><?= $dados->id?></td>
                    <td><?= $dados->nome?></td>
                    <td><?= $dados->valor?></td>
                    <td><?= $dados->descricao?></td>
                    <td><?= $dados->imagem1?></td>
                    <td><?= $dados->imagem2?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
