@extends('partial.headerFooter')
@section('content')
<div class="pt-5 pb-5" style="background-color: #f9f9f9;">
    <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
        <h4>@lang('login.login_now')</h4> <br>
        <form action="/login/auth" method="POST">
            @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">@lang('login.email')</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ Cookie::get('LoginEmail') !== NULL ? Cookie::get('LoginEmail') : old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">@lang('login.password')</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" name="password" value="{{ Cookie::get('LoginPassword') !== NULL ? Cookie::get('LoginPassword') : '' }}">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" {{ Cookie::get('LoginEmail') !== NULL ? 'checked' : '' }}>
            <label class="form-check-label" for="exampleCheck1">@lang('login.remember_me')</label>
          </div>
          @if ($errors->any())
            <div class="text-center text-danger mb-2">{{ $errors->first() }}</div>
          @endif
          <button type="submit" class="btn btn-primary" style="width: 100%">@lang('login.login')</button>
          <div class="text-center mt-3">@lang('login.account') <a href={{ route('register') }}>@lang('login.register')</a></div>
        </form>
    </div>
</div>
@endsection
