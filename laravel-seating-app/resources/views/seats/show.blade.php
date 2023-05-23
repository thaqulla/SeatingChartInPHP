@include('layouts.header')
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
                    <form action="{{ route('seats.destroy', $seat) }}" method="post">
                        @csrf
                        @method('delete')                                        
                        <button type="submit" class="btn btn-outline-danger">削除</button>
                    </form>
                </div>                 
            </div>
        </article>
    </main>

@include('layouts.footer')
</body>
</html>
