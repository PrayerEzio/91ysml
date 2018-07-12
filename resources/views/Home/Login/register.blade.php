@extends('Home.app')
@section('title', "注册-Sramer")
@section('body')
    <div class="container">

        <div class="kimi-container">
            <!--breadcrumb start-->
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}">{{ __('Home/common.index') }}</a></li>
                <li class="active">{{ __('Home/common.register') }}</li>
            </ol>

            <div class="clearfix"></div>


            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="box-bg-white col-md-12 col-xs-12 form-medium-padding">
                            <h3 class="text-center text-gray-1">{{ __('Home/common.Create Account') }}</h3>
                            <div class="clearfix maya-tiny-padding"></div>
                            <form method="post" action="{{ url('/Login/register') }}">
                                {{ csrf_field() }}
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @if(is_object($errors))
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            @elseif(is_array($errors))
                                                @foreach ($errors as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            @else
                                                <li>{{ $errors }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nickname" name="nickname" required="true" placeholder="昵称">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" required="true" placeholder="请输入邮箱">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="exampleInputPassword1" required="true" name="password" placeholder="请输入密码">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="请再次输入密码" required="true" name="password_confirmation">
                                </div>
                                <div class="form-group text-left">
                                    <div class="checkbox i-checks">
                                        <label class="no-padding">
                                            <input type="checkbox" required="true" name="register_protocol"><i></i> 我同意注册协议</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block button-green-free btn-lg">{{ __('Home/common.Create Account') }}</button>
                            </form>
                            <div class="clearfix maya-tiny-padding"></div>
                            <p class="text-center">{{ __('Home/common.Already a member') }}? <a href="login.html" class="text-secondary">{{ __('Home/common.login') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container -->
@endsection
@section('javascript')
@endsection