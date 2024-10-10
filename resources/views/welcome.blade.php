<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #ffffff; /* Fundo branco */
            color: #333; /* Texto escuro para contraste */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .welcome-container {
            background: #f8f9fa; /* Fundo levemente acinzentado */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        .welcome-container h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .btn-custom {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-login {
            background-color: #007bff; /* Cor azul para o botão de login */
        }

        .btn-register {
            background-color: #28a745; /* Cor verde para o botão de registro */
        }

        .btn-login:hover {
            background-color: #0056b3; /* Azul mais escuro no hover */
        }

        .btn-register:hover {
            background-color: #218838; /* Verde mais escuro no hover */
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Bem-vindo ao Nosso Sistema!</h1>
        <p>Por favor, faça login ou registre-se para continuar.</p>
        <a href="{{ route('login.form') }}" class="btn btn-custom btn-login">Login</a>
        <a href="{{ route('register.form') }}" class="btn btn-custom btn-register">Registrar-se</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
