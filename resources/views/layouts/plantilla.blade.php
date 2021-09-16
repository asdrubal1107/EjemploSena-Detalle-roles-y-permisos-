<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejemplo sena</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('Datatable/datatables.min.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ejemplo Sena</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            @foreach (session("menus") as $menu)
                @if ($menu->padre == "NO")
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url($menu->url) }}">{{ $menu->icono . ' ' . $menu->nombreModulo }}</a>
                  </li>
                @else
                  @if ($menu->padre == "SI")
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        {{ $menu->nombreModulo }}
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        @foreach (session("menus") as $hijo)
                            @if ($hijo->padre == $menu->id)
                              <li><a class="dropdown-item" href="{{ $hijo->url }}">{{ $hijo->icono .' '. $hijo->nombreModulo }}</a></li>
                            @endif
                        @endforeach
                      </ul>
                    </li>
                  @endif
                @endif
            @endforeach
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>
          </ul>
        </div>
      </nav>

      @yield('contenido')
      <script src="{{ asset('Datatable/JQuery.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
      <script src="{{ asset('Datatable/datatables.min.js') }}"></script>
      @yield('javascript');
</body>
</html>