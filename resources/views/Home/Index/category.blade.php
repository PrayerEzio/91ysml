@extends('Home.app')
@section('title', "$category_info->name-Sramer")
@section('css')
    <style type="text/css">
        .thumbnail_item {
            position: relative;
            overflow: hidden;
            margin-bottom: 0;
            height: 300px;
        }
        .thumbnail a>img, .thumbnail>img {
            margin-right: auto;
            margin-left: auto;
            max-height: 300px;
        }
        .box h3 {
            font-family: Roboto;
            font-size: 18px;
            font-weight: 400;
            color: #4a4a4a;
            margin-top: 10px;
            height: 30px;
        }
    </style>
@endsection
@section('body')
<div class="container-fluid less-padding kimi-container">
    <div>
        <div>
            <div class="small-slider owl-carousel owl-theme">
                @foreach($goods_category_list as $item)
                <a href="{{ url('category',['id'=>$item->id]) }}" class="item">
                    <div class="scrim"></div>
                    {{--<span class="small-text-overlay">5 Products</span>--}}
                    <p>{{ $item->name }}</p>
                    @isset($item->image)
                        <img src="{{ $item->image }}" width="100%">
                    @endisset
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="maya-tiny-padding"></div>
    <div>
        <!--breadcrumb start-->
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}">{{ __('Home/common.index') }}</a></li>
            @foreach($parents_list as $item)
                <li><a href="{{ url('/category',['id'=>$item->id]) }}">{{ $item->name }}</a></li>
            @endforeach
        </ol>

        <div class="row">
            {{--<div class="col-md-12">
                <p class="text-roboto-light">{{ $goods_count }} Products in Category <strong>{{ $category_info->name }}</strong></p>
            </div>--}}

            @foreach($goods_list as $item)
                <div class="col-sm-6 col-md-4" data-behavior="sample_code">
                    <a href="{{ url('product',['goods_sn'=>$item->goods_sn]) }}" class="thumbnail_item thumbnail less-padding less-margin">
                        <img src="{{ $item->picture }}" alt="risotto lemon">
                    </a>
                    <div class="caption box">
                        <h3>{{ $item->name }}</h3>
                        <div class="row">
                            <div class="col-sm-8 col-xs-6">
                                <p class="default-userProductList-CardList-price">¥ {{ $item->min_price }} / 件</p>
                                <span class="min-order">{{ $item->wholesale_number }} 件/批次</span>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <button onclick="location.href='shoppingCart.html'" class="btn default-userProductList-CardList-button pull-right" role="button">{{ __('Home/common.add_to_cart') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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
    </div>

</div><!-- /.container -->

@endsection

@section('javascript')
    <script>
        $('.small-slider').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            dots: false,
            responsive:{
                0:{
                    items:3.5
                },
                600:{
                    items:6
                },
                1000:{
                    items:8
                }
            }
        })
    </script>
@endsection