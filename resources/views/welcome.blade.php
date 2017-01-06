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
            <form id="shouquan" class="registration-form" data-toggle="validator" role="form" method="GET" action="{{ url('/auth') }}">

                {{--<div class="form-group form-group">--}}
                    {{--<label for="username" class="sr-only control-label">授权码</label>--}}

                        {{--<input id="code" type="text" pattern="^[_A-z0-9]{1,}$" maxlength="33"  class="form-control" name="code" placeholder="授权码" value="{{ old('code') }}" required autofocus>--}}

                {{--</div>--}}
                <div class="form-group has-feedback">
                    <label for="code" class="sr-only control-label">Twitter</label>
                        {{--<span class="input-group-addon">@</span>--}}
                        <input name="code" type="text" pattern="^[_A-z0-9]{1,}$" maxlength="35" class="form-control" id="code" placeholder="授权码" value="{{ old('code') }}" required autofocus>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors">请填写获取到的授权码</div>
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
