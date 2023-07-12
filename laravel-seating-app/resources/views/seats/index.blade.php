@extends('layouts.app')

@section('content')
    <div class="index_container">
        <!-- 生徒一覧 -->
        <article class="index_item">
            <!-- バックエンドからの結果を表示 -->
            @if (session('deleteStatus'))
                <p>{{ session('deleteStatus') }}</p>
            @endif
            <h2 class="index_head">登録一覧</h2>
            <div style="margin: 10px;">
                <!-- カラム名 -->
                <div class="student_container">
                    <div class="student_item item_center">生徒番号</div>
                    <div class="student_item item_center">氏名(漢字)</div>
                    <div class="student_item item_center">氏名(カナ)</div>
                    <div class="student_item item_center">旧コース</div>
                    <div class="student_item item_center">現コース</div>
                    <div class="student_item item_center">新入室</div>
                    <div class="student_item item_center">前方指定</div>
                    <div class="student_item item_center">詳細</div>
                    <div class="student_item item_center">編集</div>
                    <div class="student_item item_center">削除</div>
                </div>
                <!-- データ -->
                @foreach($seats as $seat)
                <div class="student_container">
                    <div class="student_item item_center">{{ $seat->studentId }}</div>
                    <div class="student_item">&nbsp;{{ $seat->name }}</div>
                    <div class="student_item">&nbsp;{{ $seat->ruby }}</div>
                    <div class="student_item item_center">{{ $seat->courceOld }}</div>
                    <div class="student_item item_center">{{ $seat->courceNow }}</div>
                    @if ($seat->newStudent == 0)
                        <div class="student_item item_center">新</div>
                    @else
                        <div class="student_item item_center">&nbsp;</div>
                    @endif
                    @if ($seat->forward == 0)
                        <div class="student_item item_center">&nbsp;</div>
                    @else
                        <div class="student_item item_center">前</div>
                    @endif
                    
                        <!-- <a href="{{ url('/button') }}">押せるボタン</a>
                        <button class="edit_button" type="submit">新規登録</button>
                    
                        <a class="btn btn-outline-success" href="{{ route('login') }}">押せないボタン</a>
                     -->
                    @if(Auth::check())
                        <div class="student_item item_center">
                            <a href="{{ route('seats.show', $seat) }}" class="btn btn-outline-primary btn-sm">詳細</a>
                        </div>
                    @else
                        <div class="student_item item_center" data-tooltip="ログインしてください">
                            <a href="#" class="disabled btn btn-outline-primary btn-sm">詳細</a>
                        </div>
                    @endif

                @if(Auth::check())
                    <div class="student_item item_center">
                        <a href="{{ route('seats.edit', $seat) }}" class="btn btn-outline-success btn-sm">編集</a>
                    </div>
                @else
                    <div class="student_item item_center">
                        <a href="#" class="disabled btn btn-outline-success btn-sm">編集</a>
                    </div>
                @endif

                @if(Auth::check())
                    <div class="student_item item_center"> 
                        <form action="{{ route('seats.destroy', $seat) }}" method="post">
                            @csrf
                            @method('delete')                                        
                            <button type="submit" class="btn btn-outline-danger btn-sm">削除</button>
                            <!-- パスワード入力ボタン -->
                            <!-- <button onclick="openPasswordPopup()">削除</button> -->
                        </form>
                    </div>
                
                @else
                    <div class="student_item item_center"> 
                        <form action="#" method="post">
                            @csrf
                            @method('delete')                             
                            <button type="submit" class="disabled btn btn-outline-danger">削除</button>
                        </form>
                    </div>
                @endif
                </div>

                @endforeach
            </div>
        </article>
        <!-- 検索 -->
        <aside class="index_item">
            <h2 class="index_head">登録とCSV</h2>
            <div>
                @if (session('flash_message'))
                    <p>{{ session('flash_message') }}</p>
                @endif
                <a href="{{ route('seats.create') }}" class="btn btn-primary btn-sm" style="margin:10px;">新規登録</a>     
                <div>
                    <a href="{{ route('downloadCSV') }}" class="btn btn-primary btn-sm" style="margin:10px;">CSVでダウンロード</a> 
                    <form style="border: solid;" action="{{ route('seats.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="seatFiles" style="margin: 10px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm" style="margin:10px;">生徒追加</button>
                    </form>
                    <form style="border: solid;" action="{{ route('scores.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="scoreFiles" style="margin: 10px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm" style="margin:10px;">成績追加</button>
                    </form>
                </div>                   
            </div>
            <h2 class="index_head">絞り込み検索</h2>
            <form action="{{ route('seats.index') }}" method="get">
                <div class="text-center">
                    <div class="box_size d-inline-block">
                        <input class="form-control me-2" type="search" name="studentId"
                            placeholder="生徒番号" value="{{ old('studentId') }}" aria-label="Search"
                            style="display: block; margin-bottom: 10px;">
                    </div>
                    <div class=" d-inline-block box_size">
                        <input class="form-control me-2" type="search" name="name"
                            placeholder="氏名（漢字）" value="{{ old('name') }}" aria-label="Search"
                            style="display: block; margin-bottom: 10px;">
                    </div>
                    <div class="d-inline-block box_size">
                        <input class="form-control me-2" type="search" name="ruby"
                            placeholder="氏名（カナ）" value="{{ old('ruby') }}" aria-label="Search"
                            style="display: block; margin-bottom: 10px;">
                    </div>
                    <button class="btn btn-outline-success btn-sm" type="submit">検索</button>
                </div>
            </form>
            
            

        <!-- JavaScript -->
        <script>
            // ファイルを選択すると、入力フォーム部分にファイル名を表示
            $('.custom-file-input').on('change',function(){
                $(this).next('.custom-file-label').html($(this)[0].files[0].name);
            })


            // function checkPassword() {
            //     var password = document.getElementById('passwordInput').value;
            //     var correctPassword = 'password123'; // 正しいパスワード（ダミーデータ）

            //     if (password === correctPassword) {
            //     // パスワードが正しい場合の処理（削除操作など）
            //     // ここに削除処理の実装を追加する

            //     // モーダルを閉じる
            //     $('#passwordModal').modal('hide');
            //     } else {
            //     alert('パスワードが間違っています。');
            //     }
            // }
            
            // // モーダルが閉じられた後に入力フィールドをリセットする
            // $('#passwordModal').on('hidden.bs.modal', function () {
            //     document.getElementById('passwordInput').value = '';
            // });

            // function openPasswordPopup() {
            //     var passwordPopup = document.getElementById('passwordPopup');
            //     passwordPopup.style.display = 'flex';
            // }

            // function checkPassword() {
            //     var password = document.getElementById('passwordInput').value;
            //     var correctPassword = 'password123'; // 正しいパスワード（ダミーデータ）

            //     if (password === correctPassword) {
            //         // パスワードが正しい場合の処理（削除操作など）
            //         // ここに削除処理の実装を追加する

            //         // ポップアップを閉じる
            //         closePasswordPopup();
            //     } else {
            //         alert('パスワードが間違っています。');
            //         closePasswordPopup();
            //     }
            // }

            // function closePasswordPopup() {
            //     var passwordPopup = document.getElementById('passwordPopup');
            //     passwordPopup.style.display = 'none';
            // }
        </script>
        </aside>
    </div>          
@endsection

