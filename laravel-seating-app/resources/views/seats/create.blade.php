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

    <main>
        <article>
            <div>                
                <h1>新規登録</h1>   
                
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

                <form action="{{ route('seats.store') }}" method="post">
                    @csrf
                    <div>
                        <label for="studentId">生徒番号</label>
                        <input type="text" name="studentId" value="{{ old('studentId') }}">
                    </div>
                    <div>
                        <label for="name">氏名</label>
                        <input type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label for="ruby">ふりがな</label>
                        <input type="text" name="ruby" value="{{ old('ruby') }}">
                    </div>
                    <div>
                        <label for="courceOld">旧コース</label>
                        <input type="text" name="courceOld" value="{{ old('courceOld') }}">
                    </div>
                    <div>
                        <label for="courceNow">現コース</label>
                        <input type="text" name="courceNow" value="{{ old('courceNow') }}">
                    </div>
                    <div>
                        <span>新入室</span>
                        <label><input type="radio" name="newStudent" value="1" value="{{ old('newStudent') }}">ON</label>
                        <label><input type="radio" name="newStudent" value="0" value="{{ old('newStudent') }}">OFF</label>
                    </div>
                    <div>
                        <span>前方指定</span>
                        <label><input type="radio" name="forward" value="1" value="{{ old('forward') }}">ON</label>
                        <label><input type="radio" name="forward" value="0" value="{{ old('forward') }}">OFF</label>
                    </div>
                    <div>
                        <label for="remarks">備考</label>
                        <textarea name="remarks" value="{{ old('remarks') }}"></textarea>
                    </div>
                    <button type="submit">新規登録</button>
                </form>
            </div>
        </article>
    </main>

    <footer>        
        <p>&copy; 座席表 All rights reserved.</p>
    </footer>
</body>

</html>
