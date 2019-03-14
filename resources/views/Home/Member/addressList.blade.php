@extends('Home.app')
@section('title', "我的地址-Sramer")
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
                <h2 class="title less-margin">我的地址</h2>
                <!--table-->
                <div class="row">
                    <div class="col-xs-12 less-padding">
                        <div class="box">
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover table-header-gray">
                                    <tr>
                                        <th>{{ __('Home/common.Requester') }}</th>
                                        <th>{{ __('Home/common.region') }}</th>
                                        <th>{{ __('Home/common.Delivery Address') }}</th>
                                        <th>{{ __('Home/common.phone') }}</th>
                                        <th>{{ __('Home/common.tag') }}</th>
                                        <th>{{ __('Home/common.Action') }}</th>
                                    </tr>
                                    @foreach ($list as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->province->name }}{{ $item->city->name }}{{ $item->district->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->tag }}</td>
                                        <td class="va-middle">
                                            <a href="{{ url('Home/Member/edit_address',['id'=>$item->id]) }}">
                                                <button class="btn button-primary">{{ __('Home/common.edit') }}</button>
                                            </a>
                                            <a href="{{ url('Home/Member/delete_address',['id'=>$item->id]) }}">
                                                <button class="btn button-primary">{{ __('Home/common.delete') }}</button>
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