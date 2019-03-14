@extends('Home.app')
@section('title', "购物车-Sramer")
@section('body')
    <div class="container">
        <div class="kimi-container">
            <!--breadcrumb start-->
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ url('/') }}">{{ __('Home/common.index') }}</a></li>
                <li>{{ __('Home/common.cart') }}</li>
            </ol>

            <div class="row">
                <div class="col-md-8">
                    <div class="box-bg-white col-md-12">
                        <h3 class="section-title">{{ __('Home/common.cart') }}</h3>
                        @foreach($data['cart'] as $item)
                        <div class="row" rowId="{{ $item->rowId }}">
                            <div class="col-md-2 col-xs-6 less-padding-right">
                                <img src="{{ $item->options->picture }}" width="100%">
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <span>{{ $item->name }}</span><br/>
                                <p class="text-gray-3 text-thin">
                                    @foreach($item->options->attributes as $attribute)
                                        {{ $attribute }}
                                    @endforeach
                                </p>
                                <p class="section-title">RMB <span id="{{ $item->rowId }}-price">{{ $item->price }}</span></p>
                                <button class="btn btn-default outline-default-button outline-small-default-button" onclick="remove_cart('{{ $item->rowId }}')">{{ __('Home/common.Remove') }}</button>
                            </div>

                            <div class="col-md-3 col-xs-7">
                                <p>{{ __('Home/common.Quantity') }}</p>
                                <div class="form-group pull-left"><button class="btn btn-default" onclick="quantity_dec('{{ $item->rowId }}',{{ $item->options->wholesale_number }})">-</button></div>
                                <div class="form-group pull-left">
                                    <input type="number" class="form-control number-input" id="{{ $item->rowId }}-qty" onchange="update_quantity('{{ $item->rowId }}',$(this).val())" value="{{ $item->qty }}" style="width: 60px;" disabled="disabled">
                                </div>
                                <div class="form-group"><button class="btn btn-default" onclick="quantity_inc('{{ $item->rowId }}',{{ $item->options->wholesale_number }})">+</button></div>
                            </div>
                            <div class="col-md-2 col-xs-5">
                                <p class="text-right">{{ __('Home/common.Subtotal') }}</p>
                                <p class="text-right section-title">RMB <span id="{{ $item->rowId }}-subtotal">{{ $item->price*$item->qty }}</span></p>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                        {{--<div class="row">
                            <div class="col-sm-12 col-xs-12 pull-right"><h4><small>{{ __('Home/common.Total') }}</small><br><span>RMB {{ $data['total'] }}</span></h4></div>
                        </div>--}}
                    </div>

                    <a href="{{ url('/Order/checkout') }}" class="btn btn-default pull-right button-black">{{ __('Home/common.Continue to checkout') }}</a>
                    <div class="clearfix maya-small-padding"></div>
                </div>

                <div class="col-md-4">
                    <div class="box-bg-white">
                        <div class="clearfix maya-small-padding"></div>
                        <h3 class="text-right text-oswald">需要帮助 ? </h3>
                        <p class="text-right text-gray-3 text-medium text-thin">如有任何疑问,请随时联系我们.</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-gray-2 text-thin">工作日<br>9.00 - 18.00</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right">+86 15013845571<br><a class="text-black text-underline" href="mailto: prayer@crucis.cn">prayer@crucis.cn</a></p>
                            </div>
                        </div>
                        <div class="clearfix maya-small-padding"></div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection
@section('javascript')
    <script>
        function quantity_dec(rowId,wholesale_number)
        {
            var qty = $('#'+rowId+'-qty').val();
            update_quantity(rowId,qty*1 - wholesale_number * 1);
        }

        function quantity_inc(rowId,wholesale_number)
        {
            var qty = $('#'+rowId+'-qty').val();
            update_quantity(rowId,qty*1 + wholesale_number * 1);
        }

        function update_quantity(rowId,qty)
        {
            var data = {'rowId':rowId,'qty':qty};
            var url = '{{ url('/Cart/update') }}';
            $.post(url,data,function(result){
                if (result.status == 200)
                {
                    $('#'+rowId+'-qty').val(qty);
                    $('#'+rowId+'-subtotal').html(($('#'+rowId+'-price').html()*1*qty).toFixed(2));
                    get_cart_list();
                    if (qty == 0)
                    {
                        $("[rowId='"+rowId+"']").remove();
                    }
                }else {
                    alert(result.message);
                }
            },'json');
        }

        function remove_cart(rowId)
        {
            var data = {'rowId':rowId};
            var url = '{{ url('/Cart/remove') }}';
            $.post(url,data,function(result){
                if (result.status == 200)
                {
                    get_cart_list();
                    $("[rowId='"+rowId+"']").remove();
                }else {
                    alert('移除失败');
                }
            },'json');
        }
    </script>
@endsection