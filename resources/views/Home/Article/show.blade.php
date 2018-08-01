@extends('Home.app')
@section('title', "$article->title-Sramer")
@section('body')
<div class="container">
    <div class="maya-tiny-padding"></div>
    <div class="kimi-container">
        <!--breadcrumb start-->
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('articles') }}">Articles</a></li>
            <li class="active">{{ $article->title }}</li>
        </ol>

        <article>
            <div class="article-header">
                <div class="row">
                    <h1 class="heading-large text-center" itemprop="name">{{ $article->title }}</h1>
                </div>

                <div class="maya-tiny-padding"></div>
                <div class="row info">
                    <p class="text-center">Article by <strong>{{ $article->author }}</strong> <span itemprop="publishedAt" datetime="{{ $article->created_at }}">{{ $article->created_at }}</span></p>
                </div>
            </div>

            <div class="article-body">
                <div class="row">
                    <div style="position: relative;">
                        <img src="{{ $article->image }}" width="100%">
                    </div>

                    <div class="col-md-10 col-md-offset-1 first-letter">
                        {!! $article->body !!}
                    </div>

                </div>
            </div>
        </article>
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