<div class="card">
    <div class="card-header">
        <h2>Cadastro de categorias</h2>

        <div class="float-right">
            <a href="listar/categorias" class="btn btn-success">
                Listar Categorias
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="salvar/categorias" method="POST">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>

            <br>

            <button type="submit" class="btn btn-success">Salvar Dados
            </button>
        </form>


    </div>
</div>