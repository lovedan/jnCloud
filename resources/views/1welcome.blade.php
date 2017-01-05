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
            <form class="registration-form" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="sr-only control-label">E-Mail/Username</label>

                        <input id="username" type="text" class="form-control" name="username" placeholder="用户名/邮箱" value="{{ old('username') }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> 记住我
                            </label>
                        </div>
                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            登陆云
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            忘记密码
                        </a>
                </div>
            </form>
        </div>
    </div>
@endsection
