<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- 独自実装のcss&jsはここに -->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}"></script>
  <title>座席表</title>    
  @vite(['resources/js/app.js'])
</head>

<body style="padding: 60px 0;">
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="height: 60px;">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('seats.index') }}">座席表</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">検索</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <!-- <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> -->
        </div>
      </div>
    </nav>
    <!-- <nav class="navbar navbar-light bg-light fixed-top" style="height: 60px;">
      <div class="container">                
        <a href="{{ route('seats.index') }}" class="navbar-brand">座席表</a>          
      </div>
    </nav> -->
  </header>