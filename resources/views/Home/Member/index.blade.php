@extends('Home.app')
@section('title', "订单列表-Sramer")
@section('css')
@endsection
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
                <h2 class="title less-margin">{{ __('Home/common.member_center') }}</h2>
                <!--table-->
                <div class="row">
                    <div class="col-xs-12 less-padding">
                        <div class="ibox-content">
                            <form class="form-horizontal m-t" id="signupForm" method="POST" action="{{ url('Member/index') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">邮箱：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{ $member_info['email'] or '' }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">头像</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" name="avatar" value="{{ $member_info['avatar'] or '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">昵称：</label>
                                    <div class="col-sm-8">
                                        <input id="nickname" name="nickname" class="form-control" type="text" value="{{ $member_info['nickname'] or '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">手机：</label>
                                    <div class="col-sm-8">
                                        <input id="phone" name="phone" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{ $member_info['phone'] or '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">店铺名称：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{ $member_info['store_name'] or '' }}" disabled>
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