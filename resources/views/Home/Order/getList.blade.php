@extends('Home.app')
@section('title', "订单列表-Sramer")
@section('body')

<div class="container-fluid kimi-container">
</div>

<div class="container-fluid" style="padding-bottom: 50px; padding-top: 20px;">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked nav-stacked-kimi">
                <li role="presentation"><a href="{{ url('/Member/index') }}">{{ __('Home/common.member_center') }}</a></li>
                <li role="presentation"><a href="{{ url('') }}">{{ __('Home/common.member_center') }}</a></li>
                <li role="presentation" class="active"><a href="{{ url('/Order/getList') }}">{{ __('Home/common.Order List') }}</a></li>
                <li role="presentation"><a href="pickupSchedule.html">Jadwal Pickup</a></li>
                <!--<li role="presentation"><a href="#">Frequently Asked Questions</a></li>-->
            </ul>
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
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
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
                                        <td><span class="label label-warning">Pending Payment</span></td>
                                        <td>{{ $item->amount }}元</td>
                                        <td class="va-middle"><button class="btn button-primary" data-toggle="modal" data-target="#orderDetail" onclick="getOrderDetail('{{ $item->order_sn }}')">{{ __('Home/common.Detail') }}</button></td>
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

            <!--modal order detail-->
            <div class="modal fade" id="orderDetail" tabindex="-1" role="dialog" aria-labelledby="orderDetail">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{ __('Home/common.Detail') }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover">
                                        <tr>
                                            <th colspan="2">{{ __('Home/common.order sn') }}<span id="order_sn"></span></th>
                                        </tr>
                                        <tr>
                                            <td width="30%">{{ __('Home/common.Requester') }}</td>
                                            <td id="requester"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Home/common.created_at') }}</td>
                                            <td id="created_at"></td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Home/common.Delivery Address') }}</td                                          <td id="delivery_address"></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 box-body table-responsive no-padding">
                                    <table class="table table-hover" id="product_list">
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Keterangan</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Nasi Bakar Ayam Woku</td>
                                            <td><img src="images/nasi_bakar_ayam_woku_2.jpg" width="60"></td>
                                            <td>Add extra Chilly Sauce</td>
                                            <td>Rp 115.000</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-roboto-light" style="margin: 10px 0">
                                        {{ __('Home/common.Payment Method') }}: <span id="payment_method"></span>
                                    </p>
                                    <p>Notes dari Admin Kimi:</p>
                                    <ul>
                                        <li class="text-roboto-light">Anda dapat melakukan request untuk penggantian tanggal.</li>
                                        <li class="text-roboto-light">Apabila dicancel mohon diberikan alasan yang jelas.</li>
                                        <li class="text-roboto-light">Estimasikan waktu pengerjaan Anda dengan cermat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
    <script>
        function getOrderDetail(sn)
        {
            var URL = '{{ url('Ajax/getOrderDetail') }}';
            var data = {sn:sn};
            $.post(URL,data,function(result)
            {
                if (result.status == 200)
                {
                    $('#order_sn').html(result.data.order_sn);
                    $('#requester').html(result.data.address.name);
                    $('#created_at').html(result.data.created_at);

                }else {
                    //todo
                }
            },'json');
        }
    </script>
@endsection