<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-5">
        <h2 class="mb-4">Gerenciamento de Produtos</h2>
        <!-- Formulário para Adicionar Novo Produto -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Adicionar Novo Produto</h5>
                <form id="addProdutoForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoria_id" class="form-label">Categoria ID</label>
                        <input type="number" class="form-control" id="categoria_id" name="categoria_id" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                </form>
            </div>
        </div>

        <!-- Tabela de Produtos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria ID</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="produtosTableBody">
                @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->name }}</td>
                    <td>{{ $produto->description }}</td>
                    <td>{{ $produto->categoria_id }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="{{ $produto->id }}" data-name="{{ $produto->name }}" data-description="{{ $produto->description }}" data-categoria_id="{{ $produto->categoria_id }}">Editar</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $produto->id }}">Deletar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Carrega os produtos na inicialização
            loadProdutos();

            // Função para carregar os produtos e preencher a tabela
            function loadProdutos() {
                $.ajax({
                    url: '{{ route("produtos.getProdutos") }}',
                    type: "GET",
                    success: function(response) {
                        let produtos = response.produtos;
                        let tableBody = "";
                        $.each(produtos, function(index, produto) {
                            tableBody += `
                    <tr>
                        <td>${produto.id}</td>
                        <td>${produto.name}</td>
                        <td>${produto.description}</td>
                        <td>${produto.categoria_id}</td>
                        <td>
                            <button class="btn btn-sm btn-warning editBtn" data-id="${produto.id}" data-name="${produto.name}" data-description="${produto.description}" data-categoria_id="${produto.categoria_id}">Editar</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${produto.id}">Deletar</button>
                        </td>
                    </tr>
                `;
                        });
                        $("#produtosTableBody").html(tableBody);
                    },
                    error: function(error) {
                        console.error("Erro ao carregar produtos:", error);
                    }
                });
            }

            // Adiciona um novo produto
            $("#addProdutoForm").on("submit", function(e) {
                e.preventDefault();
                let name = $("#name").val();
                let description = $("#description").val();
                let categoria_id = $("#categoria_id").val();
                $.ajax({
                    url: '{{ route("produtos.store") }}',
                    type: "POST",
                    data: {
                        name: name,
                        description: description,
                        categoria_id: categoria_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        alert(response.message);
                        loadProdutos();
                        $("#addProdutoForm")[0].reset();
                    },
                    error: function(error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            alert('Erro ao adicionar produto: ' + Object.values(error.responseJSON.errors).join(', '));
                        } else {
                            console.error("Erro ao adicionar produto:", error);
                        }
                    }
                });
            });

            // Edita um produto
            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                let name = prompt("Atualizar nome do produto:", $(this).data("name"));
                let description = prompt("Atualizar descrição do produto:", $(this).data("description"));
                let categoria_id = prompt("Atualizar Categoria ID:", $(this).data("categoria_id"));

                if (name && description && categoria_id) {
                    $.ajax({
                        url: `/produtos/${id}`,
                        type: "PUT",
                        data: {
                            name: name,
                            description: description,
                            categoria_id: categoria_id,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert(response.message);
                            loadProdutos();
                        },
                        error: function(error) {
                            if (error.responseJSON && error.responseJSON.errors) {
                                alert('Erro ao atualizar produto: ' + Object.values(error.responseJSON.errors).join(', '));
                            } else {
                                console.error("Erro ao editar produto:", error);
                            }
                        }
                    });
                }
            });

            // Deleta um produto
            $(document).on("click", ".deleteBtn", function() {
                if (confirm("Tem certeza que deseja deletar este produto?")) {
                    let id = $(this).data("id");
                    $.ajax({
                        url: `/produtos/${id}`,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert(response.message);
                            loadProdutos();
                        },
                        error: function(error) {
                            console.error("Erro ao deletar produto:", error);
                        }
                    });
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>