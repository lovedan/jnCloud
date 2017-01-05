@extends('layouts.loginbase')

@section('form')
    <div class="col-sm-5 text form-box">
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
            <form class="registration-form" role="form" method="GET" action="{{ url('/auth') }}">

                <div class="form-group form-group">
                    <label for="username" class="sr-only control-label">授权码</label>

                        <input id="code" type="text" class="form-control" name="code" placeholder="授权码" value="{{ old('code') }}" required autofocus>

                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            登陆云
                        </button>
                </div>
            </form>
        </div>
    </div>
@endsection
