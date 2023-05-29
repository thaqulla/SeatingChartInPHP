@include('layouts.header')
    
    <main class="index_container">             
        <!-- 生徒一覧 -->
        <article class="index_item">
            <div>
                <h2>登録一覧</h2>
                @foreach($seats as $seat)
                {{ $seat->studentId }}
                @endforeach
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
                    <div class="student_item item_center"><a href="{{ route('seats.show', $seat) }}" class="btn btn-outline-primary">詳細</a></div>
                    <div class="student_item item_center"><a href="{{ route('seats.edit', $seat) }}" class="btn btn-outline-success">編集</a></div>
                    <div class="student_item item_center"> 
                        <form action="{{ route('seats.destroy', $seat) }}" method="post">
                            @csrf
                            @method('delete')                                        
                            <button type="submit" class="btn btn-outline-danger">削除</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div> 
        </article>
        <!-- 検索 -->
        <aside class="index_item">
        <!-- style="" -->
            <div>
                <h2>登録またはCSV出力</h2>
                <div>
                    @if (session('flash_message'))
                        <p>{{ session('flash_message') }}</p>
                    @endif
                    <a href="{{ route('seats.create') }}" class="btn btn-primary">新規登録</a>     
                    <a href="{{ route('csvDownload') }}" class="btn btn-primary">CSVでダウンロード</a>                              
                </div>
                <h2>絞り込み検索</h2>
                <form>
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
                    </div>
                    <button class="btn btn-outline-success" type="submit" style="float: right;">検索</button>
                </form>

            </div>    
        </aside>
    </main>

    @include('layouts.footer')
</body>

</html>
