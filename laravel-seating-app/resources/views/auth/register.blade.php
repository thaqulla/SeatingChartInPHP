@extends('layouts.app')

@section('content')
<div class="edit_container">
    <div class="edit_head">
        <h2>{{ __('Register') }}</h2>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name" class="edit_label">{{ __('Name') }}</label>
        <input id="name" type="text" class="edit_item @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="email" class="edit_label">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="edit_item @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password" class="edit_label">{{ __('Password') }}</label>
        <input id="password" type="password" class="edit_item @error('password') is-invalid @enderror" name="password"
                required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password-confirm" class="edit_label">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="edit_item" name="password_confirmation" required autocomplete="new-password">


        <div class="row mb-0">
            <div class="col-md-4 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form><br>
</div>
@endsection
