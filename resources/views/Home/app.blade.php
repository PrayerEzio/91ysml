
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Kimi is a curated foods and beverages artisans.">
    <meta name="author" content="Philip Herlambang">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="twitter:card" content="summary">
    <meta name="title" content="Back to Kimi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="en-id">

    <!-- open graph metadata facebook, slack, whatsapp line -->
    <meta property="fb:app_id" content="150112802189143"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="Back to Kimi" />
    <meta property='og:site_name' content='Kimi | Curated Foods and Beverages' />
    <meta property="og:url" content="http://kimistatic.s3-website-ap-southeast-1.amazonaws.com/" />
    <meta property="og:description" content="Kimi is a curated foods and beverages artisans." />
    <meta property='og:image' content="https://s3-ap-southeast-1.amazonaws.com/kimistatic/images/apple-touch-icon.png" />

    <!-- open graph metadata twitter -->
    <meta name="twitter:title" content="Back to Kimi">
    <meta name="twitter:url" content="http://www.backtokimi.com">
    <meta name="twitter:description" content="Kimi is a curated foods and beverages artisans.">
    <meta name="twitter:image" content="https://s3-ap-southeast-1.amazonaws.com/kimistatic/images/apple-touch-icon.png">
    <meta name="twitter:site" content="@backtokimi">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="https://s3-ap-southeast-1.amazonaws.com/kimistatic/images/favicon.ico">
    <link rel="apple-touch-icon" href="https://s3-ap-southeast-1.amazonaws.com/kimistatic/images/apple-touch-icon.png">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/Home') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/Home') }}/css/kimi.css" rel="stylesheet">
    <link href="{{ asset('assets/Home') }}/css/font-awesome.min.css" rel="stylesheet">

    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/Home') }}/css/owl_carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('assets/Home') }}/css/owl_carousel/owl.theme.default.css">

    <!--tipue search-->
    <link rel="stylesheet" href="{{ asset('assets/Home') }}/css/tipuesearch/tipuesearch.css">

    <link rel="stylesheet" href="{{ asset('assets/Home') }}/css/prism/prism.css">
    <link href=" {{ asset('assets/Admin') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0;
        }
    </style>
    @yield('css')
</head>

<body>

@include('Home._layouts.navbar')

@yield('body')

<!--include footer-->
<div class="include-footer">
    @include('Home._layouts.footer')
</div>


<script src="{{ asset('assets/Home') }}/js/jquery.min.js"></script>

<!-- owl carousel -->
<script src="{{ asset('assets/Home') }}/js/owl_carousel/owl.carousel.js"></script>

<!--boostrap js-->
<script>window.jQuery || document.write('<script src="{{ asset('assets/Home') }}/js/vendor/jquery.min.js"><\/script>')</script>
<script src="{{ asset('assets/Home') }}/js/bootstrap.min.js"></script>

<!--tipuesearch-->
<script src="{{ asset('assets/Home') }}/js/tipusearch/tipuesearch_content.js"></script>
<script src="{{ asset('assets/Home') }}/js/tipusearch/tipuesearch_set.js"></script>
<script src="{{ asset('assets/Home') }}/js/tipusearch/tipuesearch.js"></script>
<script src="{{ asset('assets/Home') }}/js/prism/prism.js"></script>
<script src=" {{ asset('assets/Admin') }}/js/plugins/toastr/toastr.min.js"></script>

<!--kimi basic js-->
<script src="{{ asset('assets/Home') }}/js/kimi.js"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
<script type="text/javascript">
    $(function(){
        var shortCutFunction = '{{ session('alert.0') }}';
        var title = '{{ session('alert.1') }}';
        var msg = '{{ session('alert.2') }}';
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        if (shortCutFunction !== '')
        {
            toastr[shortCutFunction](msg,title);
        }
    });
</script>
@yield('javascript')
</body>
</html>