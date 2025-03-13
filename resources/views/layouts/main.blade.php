<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonte do Google -->
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet");
            </style>

        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- CSS da aplicação -->
        <link rel="stylesheet" href="/css/styler.css">
        <script src="/js/scripts.js"></script>

    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
             <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                   <img src="/img/hdcevents_logo.svg" alt="HDC Events">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Criar Eventos</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST"> <!-- Formulário de logout  -->
                            @csrf
                            <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Meus eventos</a>
                    @endauth
                    @guest <!--Diretivas de autenticação de convidado -->
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Cadastrar</a>
                    </li>
                    @endguest
                </ul>
             </div>
            </nav>
        </header>
        <!-- Validação de mensagem -->
      <main>
        <div class="container-fluid">
          <div class="row"> <!-- layout da aplicação -->
            <!-- verifica se a section está presente -->
            <!-- um if para verificar se a msg foi passada -->
           @if (session('msg'))
            <p class="msg">{{session('msg')}}</p>
           @endif
           @yield('content')
          </div>
        </div>
      <!---- yield('content') O conteúdo do site que será substituído pelo conteúdo de cada página, dinanmicamente --->
      <footer>
      <p>HDC Events &copy; 2025 </p>
      </footer>
      <script  src = "https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js" > </script>

    </body>
</html>
