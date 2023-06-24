<header>
  <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        {{ config('app.name', 'Laravel') }}
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              コース選択
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @auth
              <a class="dropdown-item" href="{{ route('seats.report') }}">全コース</a>
              <li><hr class="dropdown-divider"></li>
              @foreach($cources as $cource)
                <li>
                  <a class="dropdown-item" href="{{ route('seats.report') }}">
                    {{ $cource }}コース
                  </a>
                </li>
                <li><hr class="dropdown-divider"></li>
              @endforeach
              @endauth
              <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->
              
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <!-- <form action="/submit" method="POST">
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required><br>
            <input type="submit" value="送信">
          </form> -->
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li> -->
        </ul>
        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
 
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
          @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link btn btn-outline-success" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
          @endif

          @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link btn btn-outline-success" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-outline-success" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}&nbsp;先生
            </a>

            <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        @endguest
        </ul>
      </div>
    </div>
  </nav>
</header>