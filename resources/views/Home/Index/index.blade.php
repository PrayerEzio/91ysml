@extends('Home.app')
@section('title', "首页-Sramer")
@section('body')
    {{-- start banner --}}
    <div class="container-fluid kimi-container less-padding">
        <div class="homepage-slider owl-carousel owl-theme">
            @foreach($banner_list as $item)
                <div class="item">
                    <div class="scrim"></div>
                    <h2 class="heading-large">{{ $item->title }}</h2>
                    <p>{{ $item->sub_title }}</p>
                    {{--<div class="row-buttons">
                        <a href="channelDetail.html" class="btn button-outline text-white">Visit Store</a>
                        <a href="articleDetails.html" class="btn button-outline text-white">See Article</a>
                        <a href="#" class="btn button-outline text-white">Collect</a>
                    </div>--}}
                    <img src="{{ $item->image }}" width="100%">
                </div>
            @endforeach
        </div>
    </div>
    {{-- end banner --}}

    {{--start goods_category_list--}}
    <div class="container-fluid less-padding">
        <h2 class="default-userProductList-InfoBar-title text-center"><i class="fa fa-heart-o" aria-hidden="true"></i> Editor's Pick</h2>
        <div class="small-slider owl-carousel owl-theme">
            @foreach($goods_category_list as $goods_category)
            <a href="{{ url('category',['id'=>$goods_category->id]) }}" class="item">
                <div class="scrim"></div>
                <span class="small-text-overlay">5 Products</span>
                <p>{{ $goods_category->name }}</p>
                <img src="{{ $goods_category->image }}" width="100%">
            </a>
            @endforeach
        </div>
    </div>
    {{--end goods_category_list--}}

    <div class="clearfix maya-tiny-padding"></div>
    <div class="container">
        {{--start goods_list--}}
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <h2 class="default-userProductList-InfoBar-title text-center"><i class="fa fa-heart-o" aria-hidden="true"></i> This Week Favoourites</h2>

                @foreach($goods_list as $item)
                    <div class="col-sm-6 col-md-4" data-behavior="sample_code">
                        <a href="{{ url('product',['id'=>$item->id]) }}" class="thumbnail_item thumbnail less-padding less-margin">
                            <img class="onloadImg" src="" data-src="{{ $item->picture }}" alt="risotto lemon">
                        </a>
                        <div class="caption box">
                            <h3>{{ $item->name }}</h3>
                            <div class="row">
                                <div class="col-sm-8 col-xs-6">
                                    <p class="default-userProductList-CardList-price">¥ {{ $item->min_price }} / pcs</p>
                                    <span class="min-order">10 pcs min order</span>
                                </div>

                                <div class="col-sm-4 col-xs-6">
                                    <button onclick="location.href='{{ url('product',['id'=>$item->id]) }}'" class="btn default-userProductList-CardList-button pull-right" role="button">{{ __('Home/common.view_detail') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{--end goods_list--}}

        <div class="row">
            {{--<div class="product-detail-tag-container col-md-12 text-center">
                <button class="btn outline-white-button text-center">Load More</button>
            </div>--}}
            <div class="col-md-12 hidden-xs text-center">
                <!--pagination-->
                <nav aria-label="Page navigation">
                    {{ $goods_list->links() }}
                </nav>
                <!--pagination ends-->
            </div>
        </div>
    </div><!-- /.container -->
@endsection
@section('javascript')
@endsection