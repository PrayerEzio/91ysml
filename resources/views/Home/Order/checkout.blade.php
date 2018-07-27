@extends('Home.app')
@section('title', "确认订单-Sramer")
@section('body')
    <div class="container">

        <div class="kimi-container">
            <!--breadcrumb start-->
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/index') }}">{{ __('Home/common.index') }}</a></li>
                <li><a href="{{ url('/Cart/index') }}">{{ __('Home/common.cart') }}</a></li>
                <li>Customer Information</li>
                <li>Shipping Mehtod</li>
                <li>Payment Method</li>
            </ol>
            <div class="clearfix"></div>

            <div class="clearfix"></div>

            <div class="row">
                <form id="order_create_form" method="post" action="{{ url('/Order/create') }}">
                    {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="box-bg-white">
                        <h3 class="section-title">收货地址 <button class="btn btn-default btn-xs pull-right" type="button" data-toggle="modal" data-target="#new_address">新增</button></h3>
                        <div class="row">
                            <div class="col-md-9">
                                <!-- Modal -->
                                <div class="modal fade" id="new_address" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">新的地址</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="收货人">
                                                </div>
                                                <div class="form-group">
                                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="手机号码">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4 col-xs-4">
                                                        <select class="form-control" id="province" name="province_id" onchange="getRegionsList(this.value,2)">
                                                            <option value="0">省份</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 col-xs-4">
                                                        <select class="form-control" id="city" name="city_id" onchange="getRegionsList(this.value,3)">
                                                            <option value="0">城市</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 col-xs-4">
                                                        <select class="form-control" id="district" name="district_id">
                                                            <option value="0">区/县</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix" style="margin-bottom: 15px;"></div>

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="address" name="address" placeholder="详细地址">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="tag" name="tag" placeholder="标签">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="sort"> 设为常用地址
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveAddress()">保存</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="address_list">
                                    @empty($address_list)
                                        请添加收货地址
                                    @endempty
                                        @foreach($address_list as $key => $item)
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="address" name="address_id" id="address_{{ $key }}" value="{{ $item->id }}">
                                                    <a href="#" class="btn btn-primary btn-xs disabled">{{ $item->tag }}</a>
                                                    {{ $item->province->name }}
                                                    {{ $item->city->name }}
                                                    {{ $item->district->name }}
                                                    {{ $item->address }}
                                                    {{ $item->name }}
                                                    {{ $item->phone }}
                                                </label>
                                            </div>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="well m-t"><strong>注意：</strong> 请在30日内完成付款，否则订单会自动取消。
                    </div>
                    <a href="{{ url('/Cart/index') }}" class="text-gray-1"><i class="fa fa-angle-left" aria-hidden="true"></i> {{ __('Home/common.cart') }}</a>
                    {{--<a href="checkout2.html" class="btn btn-default pull-right button-black hidden-xs">Continue to Shipping</a>--}}
                    <a href="javascript:$('#order_create_form').submit()" class="btn btn-default pull-right button-black">确认订单 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <div class="clearfix maya-small-padding"></div>
                </div>
                </form>
                <div class="col-md-4">
                    <div class="box-bg-white hidden-xs">
                        @foreach($cart['cart'] as $item)
                        <div class="row">
                            <div class="col-md-2 col-xs-6 less-padding-right">
                                <img src="{{ $item->options->picture }}" width="100%">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <span>{{ $item->name }}</span><br/>
                                <span class="text-gray-2 text-thin">
                                    @foreach($item->options->attributes as $attribute)
                                        {{ $attribute }}
                                    @endforeach
                                </span>
                            </div>
                            <div class="col-md-4 col-xs-5">
                                <p class="text-right">{{ $item->price }}元 x {{ $item->qty }}</p>
                            </div>
                            <div class="clearfix maya-small-padding"></div>
                        </div>
                        @endforeach
                        <hr>

                        {{--<div class="row">
                            <div class="col-sm-8">Subtotal</div>
                            <div class="col-sm-4 text-right">IDR 207.000</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 less">Shipping + Transaction Fee</div>
                            <div class="col-sm-4 text-right">-</div>
                        </div>

                        <hr/>--}}
                        <div class="row">
                            <div class="col-sm-4 less">Total</div>
                            <div class="col-sm-8 text-right"><h3 class="less-margin"><small>RMB</small> {{ $cart['total'] }}</h3></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>



                    <div class="box-bg-white">
                        <div class="clearfix maya-small-padding"></div>
                        <h3 class="text-right text-oswald">Need Help ? </h3>
                        <p class="text-right text-gray-3 text-medium text-thin">Find any troubles? We will respond. Call or write question by email</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-gray-2 text-thin">Everyday<br>from 9.00 - 18.00</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right">+62 21 567898765<br><a class="text-black text-underline" href="mailto: info@backtokimi.com">info@backtokimi.com</a></p>
                            </div>
                        </div>
                        <div class="clearfix maya-small-padding"></div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container -->
@endsection
@section('javascript')
    <script>
        getRegionsList();
        function getRegionsList(parent_id = 0,level = 1)
        {
            var URL = '{{ url('Ajax/getRegionsList') }}';
            var data = {'parent_id':parent_id};
            $.post(URL,data,function(result)
            {
                if (result.status == 200)
                {
                    var html,type = '';
                    switch (level)
                    {
                        case 1:
                            type = 'province';
                            html += '<option value="0">省份</option>';
                            break;
                        case 2:
                            type = 'city';
                            html += '<option value="0">城市</option>';
                            break;
                        case 3:
                            type = 'district';
                            html += '<option value="0">区/县</option>';
                            break;
                    }
                    $.each(result.data, function(key, item) {
                        html += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $('#'+type).html(html);
                }else {
                    //todo
                }
            },'json');
        }
        function saveAddress()
        {
            var name,phone,province,city,district,address,tag;
            name = $("#new_address").find('#name').val();
            phone = $("#new_address").find('#phone').val();
            province = $("#new_address").find('#province').val();
            city = $("#new_address").find('#city').val();
            district = $("#new_address").find('#district').val();
            address = $("#new_address").find('#address').val();
            tag = $("#new_address").find('#tag').val();
            var URL = '{{ url('Ajax/saveAddress') }}';
            var data = {name:name,phone:phone,province:province,city:city,district:district,address:address,tag:tag};
            $.post(URL,data,function(result)
            {
                if (result.status == 200)
                {
                    var html = '<div class="radio"><label>\n' +
                        '                                        <input type="radio" class="address" name="address" id="address_'+result.data.id+'" value="'+result.data.id+'">\n' +
                        '                                        <a href="#" class="btn btn-primary btn-xs disabled">'+result.data.tag+'</a>\n' +
                        '                                        '+result.data.province_name+'\n' +
                        '                                        '+result.data.city_name+'\n' +
                        '                                        '+result.data.district_name+'\n' +
                        '                                        '+result.data.address+'\n' +
                        '                                        '+result.data.name+'\n' +
                        '                                        '+result.data.phone+'\n' +
                        '                                    </label></div>';
                    $("#address_list").append(html);
                }else {
                    //todo
                }
            },'json');
        }
    </script>
@endsection