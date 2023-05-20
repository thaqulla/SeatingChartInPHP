<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>座席表</title>    
    @vite(['resources/js/app.js'])
</head>

<body>
    <header>
        <nav>
            <div>                
                <a href="{{ route('seats.index') }}">登録アプリ</a>          
            </div>
        </nav>
    </header>