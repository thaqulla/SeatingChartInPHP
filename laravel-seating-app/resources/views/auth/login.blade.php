@extends('layouts.app')

@section('content')

<div class="edit_container">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="edit_head">
            <h2>{{ __('Login') }}</h2>
        </div>
        <label for="email" class="edit_label">{{ __('Email Address') }}</label>
        <input id="email" type="email"
            class="edit_item @error('email') is-invalid @enderror"
            name="email" value="{{ old('email') }}"
            required autocomplete="email" autofocus><!--form-control -->
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="password" class="edit_label">{{ __('Password') }}</label>
        <input id="password" type="password"
            class="edit_item @error('password') is-invalid @enderror"
            name="password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="edit_button btn btn-success">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
