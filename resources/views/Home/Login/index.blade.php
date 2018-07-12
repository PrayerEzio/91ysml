@extends('Home.app')
@section('title', "登录-Sramer")
@section('body')
    <div class="container">

        <div class="kimi-container">
            <!--breadcrumb start-->
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}">{{ __('Home/common.index') }}</a></li>
                <li class="active">{{ __('Home/common.login') }}</li>
            </ol>

            <div class="clearfix"></div>


            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div class="box-bg-white col-md-12 col-xs-12 form-medium-padding">
                            <h3 class="text-center text-gray-1">{{ __('Home/common.Log in with Your Account') }}</h3>
                            <div class="clearfix maya-tiny-padding"></div>
                            <form method="post" action="{{ url('/Login/index') }}">
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
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> <span class="text-gray-2 helvetica-12">Keep me Logged in</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-block button-green-free btn-lg">{{ __('Home/common.login') }}</button>
                            </form>
                            <div class="clearfix maya-tiny-padding"></div>
                            <p class="text-center">{{ __('Home/common.Not a member yet') }}? <a href="{{ url('/Login/register') }}" class="text-secondary">{{ __('Home/common.register') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection