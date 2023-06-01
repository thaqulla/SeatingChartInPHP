@include('layouts.header')

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
                    <form style="background-color: green;" action="{{ route('seats.update', $seat) }}" method="post">
                        @csrf
                        @method('patch')
                        <div>
                            <label for="name">氏名(漢字)</label>
                            <input type="text" name="name" value="{{ old('name', $seat->name) }}">
                        </div>
                        <div>
                            <label for="ruby">氏名(カナ)</label>
                            <input type="text" name="ruby" value="{{ old('ruby', $seat->ruby) }}">
                        </div>
                        <div>
                            <label for="remarks">備考</label>
                            <textarea name="remarks">{{ old('remarks', $seat->remarks) }}</textarea>
                        </div>
                        <button type="submit"  class="btn btn-outline-success">更新</button>
                    </form>
                    <a href="{{ route('seats.index') }}">&lt; 戻る</a>     
                </div>
                
            </div>
        </article>
    </main>
@include('layouts.footer')
</body>
</html>
