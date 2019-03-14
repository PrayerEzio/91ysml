@extends('Home.app')
@section('title', "订单列表-Sramer")
@section('body')

<div class="container-fluid kimi-container">
</div>

<div class="container-fluid" style="padding-bottom: 50px; padding-top: 20px;">
    <div class="row">
        <div class="col-md-3">
            @include('Home._layouts.member_leftbar')
        </div>

        <div class="col-md-9">

            <section class="edit-channel-form">
                <h2 class="title less-margin">{{ __('Home/common.reset_password') }}</h2>
                <!--table-->
                <div class="row">
                    <div class="col-xs-12 less-padding">
                        <div class="ibox-content">
                            <form class="form-horizontal m-t" id="signupForm" method="post" action="">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">当前密码：</label>
                                    <div class="col-sm-8">
                                        <input id="password" name="password" class="form-control" type="old_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">新的密码：</label>
                                    <div class="col-sm-8">
                                        <input id="password" name="password" class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">确认密码：</label>
                                    <div class="col-sm-8">
                                        <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                                        <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您新的密码</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit">保存</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!--table ends-->
            </section>
            <div class="maya-small-padding"></div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection