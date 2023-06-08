@extends('layouts.app')

@section('content')
    <div style="padding-top:25px;">
        <form id="contact" action="{{ route('seats.update', $seat) }}" method="post">
            @csrf
            @method('patch')
            
            <div class="edit_container">
                <div class="edit_head">
                    <h2>登録編集</h2>
                </div>
                @if ($errors->any())
                    <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    </div>
                @endif
                <label class="edit_label" for="name">氏名(漢字)</label>
                <input class="edit_item" type="text" name="name" value="{{ old('name', $seat->name) }}" placeholder="Name"><br>
                
                <label class="edit_label" for="ruby">氏名(カナ)</label><br>
                <input class="edit_item" type="text" name="ruby" value="{{ old('ruby', $seat->ruby) }}" placeholder="Email"><br>
                
                <label class="edit_label" for="remarks">備考</label><br>
                <textarea class="edit_item" type="text" name="remarks" placeholder="Message">{{ old('remarks', $seat->remarks) }}</textarea><br>
                
                @if(Auth::check())
                    <button id="submit" type="submit" class="edit_button">更新</button>
                @else
                    <a class="disabled edit_button" href="{{ route('login') }}">更新(ログインしてください)</a>
                @endif
                <a class="btn btn-link" href="{{ route('seats.index') }}">&lt; 戻る</a>     
                <br>
            </div>
        </form>
    </div>

@endsection