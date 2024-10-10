<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-5">
        <h2 class="mb-4">Gerenciamento de Categorias</h2>
        <!-- Formulário para Adicionar Nova Categoria -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Adicionar Nova Categoria</h5>
                <form id="addCategoriaForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome da Categoria</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
                </form>
            </div>
        </div>

        <!-- Tabela de Categorias -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="categoriasTableBody">
                @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->name }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="{{ $categoria->id }}" data-name="{{ $categoria->name }}">Editar</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $categoria->id }}">Deletar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            // Carrega as categorias na inicialização
            loadCategorias();

            // Função para carregar as categorias e preencher a tabela
            function loadCategorias() {

                $.ajax({
                    url: '{{ route("categorias.getCategorias") }}', // Utilize o método adequado
                    type: "GET",
                    success: function(response) {
                        let categorias = response.categorias;
                        let tableBody = "";
                        $.each(categorias, function(index, categoria) {
                            tableBody += `
                        <tr>
                            <td>${categoria.id}</td>
                            <td>${categoria.name}</td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn" data-id="${categoria.id}" data-name="${categoria.name}">Editar</button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="${categoria.id}">Deletar</button>
                            </td>
                        </tr>
                    `;
                        });
                        $("#categoriasTableBody").html(tableBody);
                    },
                });
            }

            // Adiciona uma nova categoria
            $("#addCategoriaForm").on("submit", function(e) {
                e.preventDefault();
                let name = $("#name").val();
                $.ajax({
                    url: '{{ route("categorias.store") }}', // Rota correta para adicionar categoria
                    type: "POST",
                    data: {
                        name: name,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        alert(response.message);
                        loadCategorias();
                        $("#addCategoriaForm")[0].reset();
                    },
                });
            });

            // Edita uma categoria
            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                let name = prompt("Atualizar nome da categoria:", $(this).data("name"));
                if (name) {
                    $.ajax({
                        url: `/categorias/${id}`, // Atualiza a URL conforme necessário
                        type: "PUT",
                        data: {
                            name: name,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert(response.message);
                            loadCategorias();
                        },
                    });
                }
            });

            // Deleta uma categoria
            $(document).on("click", ".deleteBtn", function() {
                if (confirm("Tem certeza que deseja deletar esta categoria?")) {
                    let id = $(this).data("id");
                    $.ajax({
                        url: `/categorias/${id}`, // Atualiza a URL conforme necessário
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            alert(response.message);
                            loadCategorias();
                        },
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('js/categorias.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
