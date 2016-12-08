@if(empty(session('access_token')) || empty(session('refresh_token')))
<script language='javascript'>
    location='/baidu';
</script>
@endif
@extends('layouts.loginbase')

@section('form')
    <div class="col-sm-5 form-box">
        <div class="form-top">
            <div class="form-top-left">
                <h3>登陆江南云</h3>
                <p>必须授权注册成功后才可以正常登陆:</p>
            </div>
            <div class="form-top-right">
                <i class="fa fa-pencil"></i>
            </div>
        </div>
        <div class="form-bottom">

            <form class="registration-form" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="sr-only">Name</label>

                    <input id="name" type="text" class="form-control" name="name" placeholder="昵称"  value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="sr-only control-label">Username</label>

                    <input id="username" type="text" class="form-control" name="username" placeholder="用户名" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="sr-only control-label">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" name="email" placeholder="邮箱地址" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="sr-only control-label">Password</label>

                    <input id="password" type="password" class="form-control" name="password" placeholder="密码" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="sr-only control-label">Confirm Password</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="再次输入" required>
                </div>

                <div class="form-group form-group{{ $errors->has('access_token') ? ' has-error' : '' }}">

                        <input id="access_token" type="hidden" class="form-control" name="access_token" value="{{ session('access_token') }}">

                        @if ($errors->has('access_token'))
                            <span class="help-block">
                                <strong>{{ $errors->first('access_token') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group form-group{{ $errors->has('refresh_token') ? ' has-error' : '' }}">

                        <input id="refresh_token" type="hidden" class="form-control" name="refresh_token" value="{{ session('refresh_token') }}">

                        @if ($errors->has('refresh_token'))
                            <span class="help-block">
                                <strong>{{ $errors->first('refresh_token') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            注册江南云
                        </button>
                </div>
            </form>

        </div>
    </div>
@endsection