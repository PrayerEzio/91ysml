@extends('Home.app')
@section('title', "文章-Sramer")
@section('body')
<div class="container">
    <div class="maya-tiny-padding"></div>
    <div class="kimi-container">
        <!--breadcrumb start-->
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}">{{ __('Home/common.index') }}</a></li>
            <li>{{ __('Home/common.articles') }}</li>
        </ol>

        <div class="row">
            @foreach($article_list as $item)
            <div class="col-sm-6 col-md-4">
                <a href="{{ url('article',['id'=>$item->id]) }}" class="thumbnail_item thumbnail less-padding" style="margin-bottom: 0;">
                    <img src="{{ $item->image }}" alt="article title">
                </a>
                <div class="caption box">
                    <h3>{{ $item->title }}</h3>
                    <div class="row">
                        <div class="col-sm-8 col-xs-6">
                            <p>{{ $item->author }}</p>
                            <span class="last-text">{{ $item->created_at }}</span>
                        </div>

                        {{--<div class="col-sm-4 col-xs-6">
                            <a href="profile.html">
                                <img src="images/face1.jpg" width="40" class="pull-right img-circle">
                            </a>
                        </div>--}}

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="product-detail-tag-container col-md-4 col-md-offset-4 visible-xs text-center">
                <button class="btn outline-white-button text-center">Load More</button>
            </div>

            <div class="col-md-12 hidden-xs text-center">
                <!--pagination-->
                <nav aria-label="Page navigation">
                    {{ $article_list->links() }}
                </nav>
                <!--pagination ends-->
            </div>
        </div>
    </div>

</div><!-- /.container -->
@endsection
@section('javascript')
    <script>
        $(function(){
            $("#top_navigation").load("include/top_navigation.html");
        });
    </script>
@endsection