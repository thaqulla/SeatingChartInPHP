@extends('layouts.app')

@section('content')
    <div style="padding-top:25px; padding-bottom:25px;">
        <div class="edit_container">              
            <div class="edit_head">
                <h2>新規登録</h2>  
            </div>  
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('seats.store') }}" method="post">
            @csrf
            <label class="edit_label" for="studentId">生徒番号</label>
            <input class="edit_item" type="text" name="studentId" value="{{ old('studentId') }}">

            <label class="edit_label" for="name">氏名</label>
            <input class="edit_item" type="text" name="name" value="{{ old('name') }}">

            <label class="edit_label" for="ruby">ふりがな</label>
            <input class="edit_item" type="text" name="ruby" value="{{ old('ruby') }}">

            <label class="edit_label" for="courceOld">旧コース(半角大文字アルファベット)</label>
            <input class="edit_item" type="text" name="courceOld" value="{{ old('courceOld') }}">

            <label class="edit_label" for="courceNow">現コース(半角大文字アルファベット)</label>
            <input class="edit_item" type="text" name="courceNow" value="{{ old('courceNow') }}">

            <div class="create_container">
                <div class="create_item"><!-- 新入室 -->
                    <span>新入室</span>

                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="newStudent" id="newStudent1"
                            autocomplete="off" value="1" value="{{ old('newStudent') }}"  checked>
                        <label class="btn btn-outline-danger" for="newStudent1">YES</label>

                        <input type="radio" class="btn-check" name="newStudent" id="newStudent2"
                            autocomplete="off" value="0" value="{{ old('newStudent') }}">
                        <label class="btn btn-outline-primary" for="newStudent2">NO</label>
                    </div>
                    
                </div>

                <div class="create_item"><!-- 前方指定 -->
                    <span>前方指定</span>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="forward" id="forward1"
                            autocomplete="off" value="1" value="{{ old('forward') }}">
                        <label class="btn btn-outline-danger" for="forward1">YES</label>

                        <input type="radio" class="btn-check" name="forward" id="forward2"
                            autocomplete="off" value="0" value="{{ old('forward') }}" checked>
                        <label class="btn btn-outline-primary" for="forward2">NO</label>
                    </div>
                </div>
            </div>
            


            <div>
                <label class="edit_label" for="remarks">備考</label>
                <textarea class="edit_item" name="remarks" value="{{ old('remarks') }}"></textarea>
            </div>
            @if(Auth::check())
                <button class="edit_button" type="submit">新規登録</button>
            @else
                <a class="btn btn-outline-success" href="{{ route('login') }}">押せないボタン</a>
            @endif
            
            <a class="btn btn-link" href="{{ route('seats.index') }}">&lt; 戻る</a> 
        </form>
    </div>
</div>

@endsection