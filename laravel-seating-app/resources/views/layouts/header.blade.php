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
            <a class="nav-link dropdown-toggle disabled" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              コース選択(実装中)
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

              @auth
                <form method="POST" action="{{ route('seats.report') }}">
                  @csrf
                  <input type="hidden" name="selectedCource" value="allCources">
                  <button type="submit" class="dropdown-item">
                    全コース
                  </button>
                
                  <li><hr class="dropdown-divider"></li>
                  @foreach($cources as $cource)
                    <li>
                      @csrf
                      <input type="hidden" name="selectedCource" value="{{ $cource }}">
                      <button type="submit" class="dropdown-item">
                        {{ $cource }}コース
                      </button>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                  @endforeach
                </form>
              @endauth
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="{{ route('seats.report') }}" tabindex="-1" aria-disabled="true">
              全コース
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
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