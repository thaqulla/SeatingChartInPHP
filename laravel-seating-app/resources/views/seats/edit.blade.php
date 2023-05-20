<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録編集</title>    
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

    <main>
        <article>
            <div>                
                <h1>登録編集</h1>   

                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div>
                    <a href="{{ route('seats.index') }}">&lt; 戻る</a>                                  
                </div>
                
                <form action="{{ route('seats.update', $seat) }}" method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <label for="name">氏名</label>
                        <input type="text" name="name" value="{{ old('name', $seat->name) }}">
                    </div>
                    <div>
                        <label for="remarks">備考</label>
                        <textarea name="remarks">{{ old('remarks', $seat->remarks) }}</textarea>
                    </div>
                    <button type="submit">更新</button>
                </form>
            </div>
        </article>
    </main>

    <footer>        
        <p>&copy; 登録アプリ All rights reserved.</p>
    </footer>
</body>

</html>
