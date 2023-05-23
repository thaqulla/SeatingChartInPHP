@include('layouts.header')
    
    <main>
        <article>
            <div>                
                <h1>登録一覧</h1>
                
                @if (session('flash_message'))
                     <p>{{ session('flash_message') }}</p>
                @endif
                <div>
                    <a href="{{ route('seats.create') }}">新規登録</a>                                   
                </div>
                @foreach($seats as $seat)
                
                <div class="card mb-3">
                    <p>{{ $seat->name }} {{ $seat->studentId }} {{ $seat->ruby }} <a href="{{ route('seats.show', $seat) }}">詳細</a> <a href="{{ route('seats.edit', $seat) }}">編集</a>
                 </p>
                    
                    <form action="{{ route('seats.destroy', $seat) }}" method="post">
                        @csrf
                        @method('delete')                                        
                        <button type="submit">削除</button>
                    </form>
                </div>
                @endforeach
            </div>
        </article>
        <a href="{{ route('csvDownload') }}" class="btn btn-primary">CSVでダウンロード</a>
    </main>

    @include('layouts.footer')
</body>

</html>
