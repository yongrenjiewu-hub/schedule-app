@extends('layouts.app')

@section('content')
<style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background-color: #f8f9fa;
    }

    .login-card {
        width: 100%;
        max-width: 500px;
        padding: 30px;
        border: 1px solid #ddd;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    }

    .login-header {
        text-align: center;
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 25px;
        color: #333;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        width: 100px;
    }

    .forgot-link {
        font-size: 0.9rem;
        margin-top: 10px;
        display: block;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">{{ __('ログイン') }}</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('メールアドレス') }}</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('パスワード') }}</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('ログイン状態を保持') }}
                </label>
            </div>

            {{-- ボタン --}}
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('ログイン') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('パスワードをお忘れですか？') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
