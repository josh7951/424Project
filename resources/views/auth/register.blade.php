@extends('layouts.app')

@section('content')
<div class="container">
    <img class="rounded mx-auto d-block" src="img/Comp424Logo.png" width="400px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' .$msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input onkeyup="validateFName()" id="firstname" name="firstname" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input onkeyup="validateLName()" id="lastname" name="lastname" type="text" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input onkeyup="validateUName()" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ old('name') }}" required autocomplete="username" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">Birthday</label>
                            
                            <div class="col-md-6">  
                                <input type="date" id="birthday" class="form-control" name="birthday" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input onkeyup="validateMail()" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input onkeyup="strengthMeter()" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div class="indicator">
                                    <span class="weak"></span>
                                    <span class="medium"></span>
                                    <span class="strong"></span>
                                </div>
                                <div class="indicator-text"></div>
                                <span><input type="checkbox" onclick="toggleVisibility()"> Show Password</span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input onkeyup="samePassword()" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span id="validate-status"></span>
                            </div>
                        </div>
                        
                        <div class="form-group row{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-6 offset-md-4">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submit-button" type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            <br>
                            <hr>
                            <p>Already Registered? <a href="/login">Sign in Here</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
form .indicator {
    height: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin: 10px 0;
    display: none;
}
form .indicator span{
    width: 100%;
    height: 100%;
    background: lightgrey;
    border-radius: 5px;
    position: relative;
}
form .indicator span.medium{
    margin: 0 3px;
}
form .indicator span:before{
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 5px;
}
form .indicator span.active.weak:before{
    background-color: #ff4757;
}
form .indicator span.active.medium:before{
    background-color: orange;
}
form .indicator span.active.strong:before{
    background-color: #23ad5c;
}
form .indicator-text{
    font-size: 14px;
    font-weight: 500;
    display: none;
}
form .indicator-text.weak{
    color: #ff4757;
}
form .indicator-text.medium{
    color: orange;
}
form .indicator-text.strong{
    color: #23ad5c;
}
</style>