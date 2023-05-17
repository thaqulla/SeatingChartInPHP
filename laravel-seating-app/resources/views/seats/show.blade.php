<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録情報詳細</title>
</head>

<body>
    <header>
        <nav>
            <div>                
                <a href="{{ route('seats.index') }}">登録アプリ</a>          
            </div>
        </nav>
    </header>

    <main>
        <article>
            <div>                
                <h1>登録詳細</h1>  
                @if (session('flash_message'))
                  <p>{{ session('flash_message') }}</p>
                @endif

                <div>    
                    <a href="{{ route('seats.index') }}">&lt; 戻る</a>                              
                </div>

                <div>
                    <p>{{ $seat->studentId }}</p>
                    <p>{{ $seat->name }}{{ $seat->ruby }}{{ $seat->courceOld }}{{ $seat->courceNow }}</p>
                    <p>{{ $seat->newStudent }}{{ $seat->forward }}{{ $seat->remarks }}</p>
                    <a href="{{ route('seats.edit', $seat) }}">編集</a>
                </div>                 
            </div>
        </article>
    </main>

    <footer>        
        <p>&copy; 登録アプリ All rights reserved.</p>
    </footer>
</body>

</html>
