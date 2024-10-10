<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Imagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-5">
        <h2 class="mb-4">Gerenciamento de Imagens</h2>

        <!-- Formulário para Adicionar Nova Imagem -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Adicionar Nova Imagem</h5>
                <form id="addImageForm">
                    @csrf <!-- Token CSRF adicionado aqui -->
                    <div class="mb-3">
                        <label for="imageable_id" class="form-label">ID do Item</label>
                        <input type="number" class="form-control" id="imageable_id" name="imageable_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="imageable_type" class="form-label">Tipo do Item</label>
                        <input type="text" class="form-control" id="imageable_type" name="imageable_type" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Selecionar Imagem</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Imagem</button>
                </form>
            </div>
        </div>

        <!-- Tabela de Imagens -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID do Item</th>
                    <th>Tipo do Item</th>
                    <th>Nome do Arquivo</th>
                    <th>URL</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="imagesTableBody">
                @foreach ($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>{{ $image->imageable_id }}</td>
                    <td>{{ $image->imageable_type }}</td>
                    <td>{{ $image->filename }}</td>
                    <td><a href="{{ $image->url }}" target="_blank">Ver Imagem</a></td>
                    <td>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $image->id }}">Deletar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script>
        $(document).ready(function() {
            // Carrega as imagens na inicialização
            loadImages();
            var routeGetImages = "{{ route('images.index') }}";
            var routeStoreImage = "{{ route('images.store') }}";

            // Configura o token CSRF para as requisições AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadImages() {
                $.ajax({
                    url: routeGetImages,
                    type: "GET",
                    success: function(response) {
                        if (response.images.length > 0) {
                            let images = response.images;
                            let tableBody = "";
                            $.each(images, function(index, image) {
                                tableBody += `
                    <tr>
                        <td>${image.id}</td>
                        <td>${image.imageable_id}</td>
                        <td>${image.imageable_type}</td>
                        <td>${image.filename}</td>
                        <td><a href="${image.url}" target="_blank">Ver Imagem</a></td>
                        <td>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${image.id}">Deletar</button>
                        </td>
                    </tr>
                `;
                            });
                            $("#imagesTableBody").html(tableBody);
                        } else {
                            $("#imagesTableBody").html("<tr><td colspan='6' class='text-center'>Nenhuma imagem encontrada.</td></tr>");
                        }
                    },
                    error: function(xhr) {
                        alert("Erro ao carregar imagens: " + xhr.responseJSON.message);
                    }
                });
            }

            // Adiciona uma nova imagem
            $("#addImageForm").on("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: routeStoreImage,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response.message);
                        loadImages();
                        $("#addImageForm")[0].reset();
                    },
                    error: function(xhr) {
                        alert("Erro ao adicionar a imagem: " + xhr.responseJSON.message);
                    },
                });
            });

            // Deleta uma imagem
            $(document).on("click", ".deleteBtn", function() {
                if (confirm("Tem certeza que deseja deletar esta imagem?")) {
                    let id = $(this).data("id");
                    $.ajax({
                        url: `/images/${id}`,
                        type: "DELETE",
                        success: function(response) {
                            alert(response.message);
                            loadImages();
                        },
                        error: function(xhr) {
                            alert("Erro ao deletar a imagem: " + xhr.responseJSON.message);
                        },
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>