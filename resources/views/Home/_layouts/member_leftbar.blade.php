<ul class="nav nav-pills nav-stacked nav-stacked-kimi">
    @php $route = getCurrentRoute(); @endphp
    <li role="presentation" @if($route['controller'] == 'MemberController' && $route['action'] == 'index') class="active" @endif><a href="{{ url('/Member/index') }}">{{ __('Home/common.member_center') }}</a></li>
    <li role="presentation" @if($route['controller'] == 'MemberController' && $route['action'] == 'wallet') class="active" @endif><a href="{{ url('/Member/wallet') }}">{{ __('Home/common.wallet') }}</a></li>
    <li role="presentation" @if($route['controller'] == 'OrderController' && $route['action'] == 'getList') class="active" @endif><a href="{{ url('/Order/getList') }}">{{ __('Home/common.order_list') }}</a></li>
    <li role="presentation" @if($route['controller'] == 'MemberController' && $route['action'] == 'collectList') class="active" @endif><a href="{{ url('/Member/collect_list') }}">{{ __('Home/common.collect_list') }}</a></li>
    <li role="presentation" @if($route['controller'] == 'MemberController' && $route['action'] == 'addressList') class="active" @endif><a href="{{ url('/Member/address_list') }}">{{ __('Home/common.address_list') }}</a></li>
    <li role="presentation" @if($route['controller'] == 'MemberController' && $route['action'] == 'resetPassword') class="active" @endif><a href="{{ url('/Member/reset_password') }}">{{ __('Home/common.reset_password') }}</a></li>
    <li role="presentation"><a href="{{ url('/Member/logout') }}">{{ __('Home/common.logout') }}</a></li>
</ul>