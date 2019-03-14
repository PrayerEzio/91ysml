@extends('Home.app')
@section('title', "订单列表-Sramer")
@section('body')

<div class="container-fluid kimi-container">
</div>

<div class="container-fluid" style="padding-bottom: 50px; padding-top: 20px;">
    <div class="row">
        <div class="col-md-3">
            @include('Home._layouts.member_leftbar')
            {{--<div style="background: #FCFCFC; border: 1px solid #E7EAEA; margin-top: 30px; padding: 15px;" class="hidden-xs">
                <h2>Sucicakes</h2>
                <h4>This week Sales:</h4>
                <h2>Rp 40.000</h2>
                <p>Anda belum berlangganan <a href="#" class="text-secondary">Premium Merchant</a> </p>
                <p>Berminat jadi Premium Merchant?
                    Coba gratis selama 1 bulan.
                    <a href="#" class="text-secondary"> Klik disini</a></p>
            </div>--}}
        </div>

        <div class="col-md-9">

            <section class="edit-channel-form">
                <h2 class="title less-margin">订单列表</h2>
                <div class="box-header">
                    <div class="ibox-content">
                        {{--<form method="GET" action="">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="order_sn" class="form-control pull-right" placeholder="订单号">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>--}}
                        <form id="filter_form" method="get" action="">
                            <div class="row">
                                <div class="col-sm-5 m-b-xs">
                                    <div data-toggle="buttons" class="">
                                        @php !isset($input['status']) ? $input['status'] = '' : '';@endphp
                                        <label class="btn btn-sm btn-white {{ $input['status']=='' ? 'active' : ''}}">
                                            <input type="radio" id="all" name="status" value="">全部订单</label>
                                        <label class="btn btn-sm btn-white {{ $input['status'] == 1 ? 'active' : ''}}">
                                            <input type="radio" id="status1" name="status" value="1">未支付</label>
                                        <label class="btn btn-sm btn-white {{ $input['status'] == 2 ? 'active' : ''}}">
                                            <input type="radio" id="status2" name="status" value="2">已付款</label>
                                        <label class="btn btn-sm btn-white {{ $input['status'] == 3 ? 'active' : ''}}">
                                            <input type="radio" id="status3" name="status" value="3">已发货</label>
                                        <label class="btn btn-sm btn-white {{ $input['status'] == 4 ? 'active' : ''}}">
                                            <input type="radio" id="status4" name="status" value="4">已收货</label>
                                        <label class="btn btn-sm btn-white {{ $input['status'] == 5 ? 'active' : ''}}">
                                            <input type="radio" id="status5" name="status" value="5">已完成</label>
                                        <label class="btn btn-sm btn-white {{ $input['status'] == -1 ? 'active' : ''}}">
                                            <input type="radio" id="status-1" name="status" value="-1">已取消</label>
                                    </div>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="start" value="{{ $input['start'] or '' }}"/>
                                        <span class="input-group-addon">至</span>
                                        <input type="text" class="input-sm form-control" name="end" value="{{ $input['end'] or '' }}"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" placeholder="请输入订单号" class="input-sm form-control" name="sn" value="{{ $input['sn'] or '' }}"> <span
                                                class="input-group-btn">
                                            <button class="btn btn-sm btn-primary"> 搜索</button> </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--table-->
                <div class="row">
                    <div class="col-xs-12 less-padding">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover table-header-gray">
                                    <tr>
                                        <th>{{ __('Home/common.order sn') }}</th>
                                        <th>{{ __('Home/common.created_at') }}</th>
                                        <th>{{ __('Home/common.Status') }}</th>
                                        <th>{{ __('Home/common.Amount') }}</th>
                                        <th>{{ __('Home/common.Action') }}</th>
                                    </tr>
                                    @foreach ($order_list as $item)
                                    <tr>
                                        <td>{{ $item->order_sn }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @switch($item->status)
                                                @case(-1)
                                                <span class="label labe-danger">{{ $item->getStatusName($item) }}</span>
                                                @break
                                                @case(1)
                                                <span class="label label-warning">{{ $item->getStatusName($item) }}</span>
                                                @break
                                                @case(5)
                                                <span class="label label-success">{{ $item->getStatusName($item) }}</span>
                                                @break
                                                @default
                                                <span class="label label-default">{{ $item->getStatusName($item) }}</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $item->amount }}元</td>
                                        <td class="va-middle">
                                            <a href="{{ url('Home/Order/detail',['sn'=>$item->order_sn]) }}">
                                                <button class="btn button-primary">{{ __('Home/common.Detail') }}</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.box-body -->
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
    <script src="{{ asset('assets/Admin') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script>
        $('input:radio[name="status"]').change(function () {
            $("#filter_form").submit();
        });
        $('.input-daterange').datepicker({
            language: "zh-CN",
            autoclose:true,
        });
    </script>
@endsection