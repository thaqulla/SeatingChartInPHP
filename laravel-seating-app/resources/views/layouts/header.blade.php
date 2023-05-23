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
    <nav class="navbar navbar-light bg-light fixed-top" style="height: 60px;">
      <div class="container">                
        <a href="{{ route('seats.index') }}" class="navbar-brand">座席表</a>          
      </div>
    </nav>
  </header>