@extends('layouts.app')

@section('content')
<h2 class="index_head">成績CSVインポート</h2>
<div>
    @if (session('flash_message'))
        <p>{{ session('flash_message') }}</p>
    @endif
    <div>
        <a href="{{ route('downloadCSV') }}" class="btn btn-primary btn-sm" style="margin:10px;">CSVでダウンロード</a> 
        <form action="{{ route('seats.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="seatFiles" style="margin:10px;">
            <button type="submit" class="btn btn-outline-primary btn-sm" style="margin:10px;">アップロード</button>
        </form>
    </div>                   
</div>
@endsection

