<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿一覧</title>
</head>

<body>
    <header>
        <nav>
            <div>
            <a href="{{ route('seats.index') }}">投稿アプリ</a>          
            </div>
        </nav>
    </header>
    
    <main>
        <article>
            <div>                
                <h1>投稿一覧</h1>
                
                @if (session('flash_message'))
                     <p>{{ session('flash_message') }}</p>
                @endif
                <div>
                    <a href="{{ route('seats.create') }}">新規投稿</a>                                   
                </div>               
            </div>
        </article>
    </main>

    <footer>        
        <p>&copy; 投稿アプリ All rights reserved.</p>
    </footer>
</body>

</html>
