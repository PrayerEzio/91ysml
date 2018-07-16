<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid hidden-xs">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <button class="pull-left search-button" id="buttonOpenSearchbar"><i class="fa fa-search" aria-hidden="true"></i></button>
                <button class="pull-left search-button hide" id="buttonCloseSearchbar"><i class="fa fa-times" aria-hidden="true"></i></button>

                <div id="searchbar" class="hide">
                    <div>
                        <div class="top-nav-searchbar">
                            <div class="input-group">
                                <form action="{{ url('search') }}">
                                    <input class="form-control" type="text" name="q" id="tipue_search_input" placeholder="Search for" autofocus="autofocus">
                                </form>
                            </div><!-- input-group -->
                        </div>
                    </div>
                </div>
                <p class="help-text hidden-sm hidden-md" id="helpText">有任何疑问? 请联系我们的邮箱 <a href="mailto:prayer@crucis.cn" class="text-secondary">prayer@crucis.cn</a> </p>
            </div>
            <div class="col-md-4 col-sm-4">
                <p class="text-center logo-container"><a href="index.html"><img src="{{asset('Home')}}/images/logo.png" width="100"></a></p>
            </div>
            <div class="col-md-4 less-padding-right">
                @if (session('user_info'))
                    <a href="{{ url('/Member/index') }}" class="btn pull-right button-green-top-nav">{{ __('Home/common.member_center') }}</a>
                @else
                    <a href="{{ url('/Login/index') }}" class="btn pull-right button-green-top-nav">{{ __('Home/common.login_or_register') }}</a>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white">
        <div class="navbar-header pull-left">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar icon-short"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar icon-medium"></span>
            </button>
        </div>
        <div class="visible-xs logo-center">
            <p class="text-center logo-container visible-xs"><a href="index.html"><img src="{{asset('Home')}}/images/logo.png" width="90"></a></p>
        </div>
        <div class="visible-xs pull-right">
            <button class="pull-left search-button-mobile" id="buttonOpenSearchbarMobile"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="clearfix"></div>

        <div class="fly-searchbar" style="display: none;">
            <div class="top-nav-searchbar searchbar-mobile">
                <div class="input-group">
                    <form action="search.html">
                        <input class="form-control" type="text" name="q" id="tipue_search_input" placeholder="Search for" autofocus="autofocus">
                    </form>
                    <button class="pull-right" id="buttonCloseSearchbarMobile"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>


        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li @if ($top_navbar == __('Home/common.shop'))class="active"@endif><a href="{{ url('/') }}">{{ __('Home/common.shop') }}</a></li>
                <li @if ($top_navbar == __('Home/common.articles'))class="active"@endif><a href="{{ url('articles') }}">{{ __('Home/common.articles') }}</a></li>
                <li @if ($top_navbar == __('Home/common.FAQs'))class="active"@endif><a href="questions.html">{{ __('Home/common.FAQs') }}</a></li>
                <li @if ($top_navbar == __('Home/common.about_us'))class="active"@endif><a href="{{ url('about_us') }}">{{ __('Home/common.about_us') }}</a></li>
                <li @if ($top_navbar == __('Home/common.contact_us'))class="active"@endif><a href="{{ url('contact_us') }}">{{ __('Home/common.contact_us') }}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ __('Home/common.cart') }} (<span id="cart_count">0</span>)</a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="cart-flyout">

                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>