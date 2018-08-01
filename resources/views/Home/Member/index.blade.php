@extends('Home.app')
@section('title', "首页-Sramer")
@section('body')

<div class="container kimi-container" style="">
    <ol class="breadcrumb hidden-xs">
        <li><a href="index.html">Home</a></li>
        <li>Channel Dashboard</li>
    </ol>
</div>

<div class="container bg-white-container weekly-summary top-gray-border hidden-xs">
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-red">New Order<small class="pull-right" style="line-height: 34px;"><a href="#" class="text-secondary">Go to Order List</a></small></h3>
            <h4>Sigit Setiadji</h4>
            <p>5 Nasi Bakar Ayam Woku</p>
            <strong>Tomorrow 4 PM</strong>
            <address>
                Gedung Graha Mitra Lt 10 Jl Gatot Subroto Kav 22 Jakarta Selatan 12950
            </address>
            <button class="btn button-gray-3">See Details</button>
            <button class="btn button-red">Reject with reason</button>
        </div>
        <div class="col-md-4">
            <h3 class="text-red">This Week Sales</h3>
            <h2>Rp 40.000</h2>
            <p>1 Transaction</p>
        </div>
        <div class="col-md-4">
            <h3 class="text-red">Payment Method</h3>
            <p>Bank Transfer : Rp 40.000</p>
        </div>
    </div>
</div>

<div class="container bg-white-container weekly-summary top-gray-border hidden-xs">
    <div class="col-md-2 col-xs-6 less-padding">
        <strong>This Week Visitor</strong>
        <h2 class="text-secondary">150</h2>
        <p><i class="fa fa-arrow-up" aria-hidden="true"></i> <small>10% from last week</small></p>
    </div>

    <div class="col-md-2 col-xs-6 less-padding">
        <strong>Average Visit Time</strong>
        <h2 class="text-secondary">5 Mins</h2>
        <p><i class="fa fa-arrow-up" aria-hidden="true"></i> <small>20% from last week</small></p>
    </div>

    <div class="col-md-2 col-xs-6 less-padding">
        <strong>Total Sales</strong>
        <h2 class="text-secondary">2</h2>
        <p><i class="fa fa-arrow-down text-red" aria-hidden="true"></i> <small>10% from last week</small></p>
    </div>

    <div class="col-md-2 col-xs-6 less-padding">
        <strong>Omset</strong>
        <h2 class="text-secondary">Rp 40.000</h2>
        <p><i class="fa fa-arrow-down text-red" aria-hidden="true"></i> <small>20% from last week</small></p>
    </div>

    <div class="col-md-2 col-xs-6 less-padding">
        <strong>Canceled Transaction</strong>
        <h2 class="text-secondary">0</h2>
        <p><small>0% from last week</small></p>
    </div>

    <div class="col-md-2 col-xs-6 less-padding">
        <strong>Total Revenue</strong>
        <h2 class="text-secondary">Rp 40.000</h2>
        <p><small>0% from last week</small></p>
    </div>
</div>

<div class="container channel-cover">
    <img src="{{ asset('assets/Home') }}/images/coverSucicakes.jpg" class="cover-image">
    <div class="hidden-xs channel-info">
        <h1 class="text-red">Sucicakes</h1>
        <img src="{{ asset('assets/Home') }}/images/premium.png" class="pull-left">
        <h4 style="margin-left: 10px; float: left;">Premium Seller</h4>
        <div class="clearfix maya-small-padding"></div>
        <img src="{{ asset('assets/Home') }}/images/halal35.png">
    </div>
</div>

<div class="container hidden-xs bg-white" style="padding-bottom: 20px;">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-2 hidden-xs">
            <p class=""><img src="{{ asset('assets/Home') }}/images/sucicakes_logo.png" width="100"></p>
        </div>

        <div class="col-md-3">
            <p>Page: <a href="#" class="text-secondary">backtokimi.com/sucicakes</a></p>
            <p>Coverage: Jabodetabek</p>
            <p>Location: Kebon Jeruk, Jakarta Barat</p>
        </div>
        <div class="col-md-4">
            <p>Last Logged in: Wed 23 Agustus 2017</p>
            <p>Join: April 2017</p>
            <p>Favourites: 290</p>
        </div>
        <div class="col-md-3">
            <!--<button class="button-gray-2 btn btn-block">Make Favourite</button>-->
            <!--<div class="clearfix" style="margin-bottom: 15px;"></div>-->
            <!--<a href="channelDashboard.html" class="button-gray-2 btn btn-block">Go to My Dashboard</a>-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <!--<img src="{{ asset('assets/Home') }}/images/sucicakes_logo.png">-->
            <!--&lt;!&ndash;<a href="channelEdit.html" class="btn button-red">Edit</a>&ndash;&gt;-->
        </div>
        <div class="col-md-3">
            <strong>Saldo di Kimi</strong>
            <h3 class="text-secondary">Rp 200.000</h3>
            <!--<button class="btn button-red">Request Cairkan Dana</button>-->
        </div>
        <div class="col-md-3">
            <p>Page: <a href="channelDetail.html" class="text-secondary">backtokimi.com/sucicakes</a></p>
            <p>Email: <a class="text-secondary" href="mailto:suci.herlambang@gmail.com">suci.herlambang@gmail.com</a></p>
            <p>Phone: 082114666232</p>
        </div>
        <div class="col-md-4">
            <address>
                Address: Jl Madrasah 2 no 30 D RT 8 / RW 2
                Kelurahan Sukabumi Utara Kecamatan Kebon Jeruk
                Jakarta Barat 11540
            </address>
            <a href="channelEdit.html" class="btn button-red">Edit</a>
        </div>
    </div>
</div>

<div class="container visible-xs" style="padding-top: 15px; background: white; padding-bottom: 10px; border-bottom: 1px solid #E7EAEA;">
    <div class="row">
        <div class="col-xs-1" style="padding-left: 5px;">
            <img src="{{ asset('assets/Home') }}/images/premium_badge.png" style="margin-top: 10px;">
        </div>
        <div class="col-xs-3 less-padding-left">
            <img src="{{ asset('assets/Home') }}/images/sucicakes_logo.png" width="100%">
        </div>
        <div class="col-xs-8 less-padding-left">
            <p class="helvetica-18 text-bold less-margin less-padding" style="margin-top: 10px;">Sucicakes</p>
            <a href="editProfile.html" class="text-red helvetica-12 text-bold">{{ __('Home/common.Edit Profile') }}</a>
        </div>
    </div>
</div>

<div class="container visible-xs" style="padding-top: 15px; background: white; padding-bottom: 10px; border-bottom: 1px solid #E7EAEA;">
    <div class="row">
        <div class="col-xs-4">
            <p class="text-bold helvetica-14 less-margin">预存款</p>
            <span class="text-secondary text-bold">RMB 200.000</span>
        </div>
        <div class="col-xs-4">
            <p class="text-bold helvetica-14 less-margin">积分</p>
            <span class="text-secondary text-bold">Rp 40.000</span>
        </div>
        <div class="col-xs-2" style="margin-top: 10px;">
            <a href="#" class="btn button-gray-3">{{ __('Home/common.Detail') }}</a>
        </div>
    </div>
</div>

<div class="container visible-xs" style="padding-top: 15px; background: white; padding-bottom: 10px; border-bottom: 1px solid #E7EAEA;">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-red">{{ __('Home/common.New Order') }}<small class="pull-right" style="line-height: 34px;"><a href="#" class="text-secondary">{{ __('Home/common.Order List') }}</a></small></h3>
            <h4>Sigit Setiadji</h4>
            <p>5 Nasi Bakar Ayam Woku</p>
            <strong>Tomorrow 4 PM</strong>
            <address>
                Gedung Graha Mitra Lt 10 Jl Gatot Subroto Kav 22 Jakarta Selatan 12950
            </address>
            <button class="btn button-gray-3">See Details</button>
            <button class="btn button-red">Reject with reason</button>
        </div>
    </div>
</div>

@endsection
@section('javascript')
@endsection