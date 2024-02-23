<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .main-content {
            margin-top: 5rem;
        }

        .button-container {
            display: flex;
            gap: 5px; /* Espaçamento entre os botões */
        }

        .button-container > * {
            flex: 1; /* Os botões irão ocupar o mesmo espaço */
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Conteúdo da aplicação --}}
    <main class="container-lg main-content">
        {{-- Messages --}}
        @include('layouts.partials.messages')

        @yield('content')
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
