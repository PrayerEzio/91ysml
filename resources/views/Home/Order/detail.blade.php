@extends('Home.app')
@section('title', "订单详情-Sramer")
@section('css')
    <style>
        .p-xl {
            padding: 40px;
        }
        .m-t {
            margin-top: 15px;
        }
        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
        }
        .invoice-table tbody>tr>td:last-child, .invoice-table tbody>tr>td:nth-child(2), .invoice-table tbody>tr>td:nth-child(3), .invoice-table tbody>tr>td:nth-child(4), .invoice-table thead>tr>th:last-child, .invoice-table thead>tr>th:nth-child(2), .invoice-table thead>tr>th:nth-child(3), .invoice-table thead>tr>th:nth-child(4), .invoice-total>tbody>tr>td:first-child {
             text-align: right;
        }
        .invoice-total>tbody>tr>td {
            border: 0 none;
        }
        .invoice-total>tbody>tr>td:last-child {
            border-bottom: 1px solid #DDD;
            text-align: right;
            width: 15%;
        }
        .text-navy {
            color: #1ab394;
        }

        .timeline-item .date {
            text-align: left;
            width: 110px;
            position: relative;
            padding-top: 30px
        }

        .timeline-item .date i {
            right: auto;
            position: absolute;
            top: 0;
            left: 15px;
            padding: 5px;
            width: 30px;
            text-align: center;
            border: 1px solid #e7eaec;
            background: #f8f8f8
        }

        .timeline-item .content {
            border-left: 1px solid #e7eaec;
            border-top: 1px solid #e7eaec;
            padding-top: 10px;
            min-height: 100px;
        }

        .timeline-item .content:hover {
            background: #f6f6f6
        }

        .ibox-content {
            clear: both;
            background-color: #fff;
            color: inherit;
            border-color: #e7eaec;
            -webkit-border-image: none;
            -o-border-image: none;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0;
        }

        .no-top-border {
            border-top: 0!important;
        }

        .content {
            background-color: #fff;
        }
    </style>
@endsection
@section('body')
    <div class="container">
        <div class="kimi-container">
            <!--breadcrumb start-->
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/index') }}">{{ __('Home/common.index') }}</a></li>
                <li><a href="{{ url('/Member/index') }}">{{ __('Home/common.member_center') }}</a></li>
                <li><a href="{{ url('/Order/getList') }}">{{ __('Home/common.order_list') }}</a></li>
                <li>{{ __('Home/common.order_detail') }}</li>
            </ol>
            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <div class="row">
                <form id="order_pay_form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="col-sm-12">
                        <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        {{--<strong>北京百度在线网络技术有限公司</strong><br>
                                        北京市海淀区上地十街10号<br>
                                        <abbr title="Phone">总机：</abbr> (+86 10) 5992 8888--}}
                                    </address>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <h4>订单编号：</h4>
                                    <h4 class="text-navy">{{ $order_info->order_sn }}</h4>
                                    <address>
                                        <strong>{{ $order_info->user->nickname }}</strong><br>
                                        {{ $order_info->address->province->name }}
                                        {{ $order_info->address->city->name }}
                                        {{ $order_info->address->district->name }}
                                        {{ $order_info->address->address }}
                                        <br>
                                        <abbr title="Phone">手机：</abbr> {{ $order_info->address->phone }}
                                    </address>
                                    <p>
                                        <span><strong>日期：</strong> {{ $order_info->created_at }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>清单</th>
                                        <th>规格</th>
                                        <th>数量</th>
                                        <th>单价</th>
                                        <th>总价</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_info->products as $order_product)
                                    <tr>
                                        <td>
                                            <div><strong>{{ $order_product->goods_name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            @isset($order_product->attributes)
                                                @foreach($order_product->attributes as $attribute)
                                                    {{ $attribute->value }}
                                                @endforeach
                                            @else
                                                /
                                            @endisset
                                        </td>
                                        <td>{{ $order_product->qty }}</td>
                                        <td>&yen;{{ $order_product->price }}</td>
                                        <td>&yen;{{ $order_product->price*$order_product->qty }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /table-responsive -->
                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>总价：</strong>
                                    </td>
                                    <td>&yen;{{ $order_info->amount }}</td>
                                </tr>
                                </tbody>
                            </table>
                            @switch ($order_info->status)
                                @case (1)
                                    <div class="well m-t">
                                        <h3 class="section-title">支付方式</h3>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment_method" id="perpay" value="perpay" checked aria-label="...">
                                                        预付款
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment_method" id="alipay" value="alipay" aria-label="...">
                                                        支付宝
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment_method" id="wechat" value="wechat" aria-label="...">
                                                        微信
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment_method" id="paypal" value="paypal" aria-label="...">
                                                        paypal
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary" type="button" onclick="pay()"><i class="fa fa-dollar"></i> 去付款</button>
                                    </div>
                                    @break
                                @case (3)
                                    <div class="text-right">
                                        <button class="btn btn-primary" type="button" onclick="confirm_receipt()"><i class="fa fa-dollar"></i> 确认收货</button>
                                    </div>
                                    @break
                                @default
                                    @break
                            @endswitch
                            @foreach($order_info->logs as $log)
                                <div class="ibox-content timeline">
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-3 date">
                                                {{ $log->created_at }}
                                                <br>
                                                <small class="text-navy">{{ $log->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="col-xs-7 content no-top-border">
                                                <p class="m-b-xs"><strong>{{ $log->title }}</strong></p>
                                                <p>{{ $log->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div><!-- /.container -->
@endsection
@section('javascript')
    <script>
        function pay()
        {
            var payment_method = $("input[name='payment_method']:checked").val();
            if (payment_method == undefined)
            {
                alert('请选择支付方式');
            }
            $("#order_pay_form").attr('action',"{{ url('/Order/payOrder',['sn'=>$order_info->order_sn]) }}");
            $("#order_pay_form").submit();
        }

        function confirm_receipt()
        {

        }
    </script>
@endsection