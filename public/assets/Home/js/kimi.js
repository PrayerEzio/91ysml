/*
 * Copyright (c) 2018. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */
function get_cart_list()
{
    var url = '/Cart/index';
    $.post(url,'',function(result){
        if (result.status == 200)
        {
            var html = '<h4 class="text-oswald">购物车</h4>';
            if (result.data.cart.length == 0)
            {
                html += '<div class="row">\n' +
                    '                                    <div class="col-xs-12 text-center">\n' +
                    '                                        <img src="http://alpha.91ysml.net/assets/Home/images/IG_8.svg" width="50">\n' +
                    '                                        <div class="maya-tiny-padding"></div>\n' +
                    '                                        <p class="text-roboto-light">您的购物车空空如也</p>\n' +
                    '                                    </div>\n' +
                    '                                </div>';
            }else {
                $.each(result.data.cart, function(key, item) {
                    html += '<div class="row">\n' +
                        '                                    <div class="col-sm-2 col-xs-3 less-padding">\n' +
                        '                                        <img src="'+item.options.picture+'" width="100%">\n' +
                        '                                    </div>'+
                        '                                    <div class="col-sm-8 col-xs-9">\n' +
                        '                                        <span class="text-gray-1">'+item.name+'</span>\n' +
                        '                                        <p class="text-gray-2">'+item.qty + ' x ' + item.price+'</p>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                });
                html += '<hr>';
                html += '<div class="row">\n' +
                    '                                    <div class="col-sm-6 col-xs-6 less-padding"><h4><small>总计</small><br><span>'+result.data.total+' 元</span></h4></div>\n' +
                    '                                    <div class="col-sm-6 col-xs-6 less-padding">\n' +
                    '                                        <a href="/Cart/index" class="button-green-top-nav btn pull-right btn-block text-oswald text-uppercase">查看购物车</a>\n' +
                    '                                    </div>\n' +
                    '                                </div>';
            }
            $('.cart-flyout').html(html);
            $('#cart_count').html(result.data.count);
        }
    },'json');
}
(function () {
    var default_img = '/Home/images/add_photo_mobile.png';
    $(function()
    {
        $('.onloadImg').each(function () {
            $(this).attr('src',default_img);
        });
        onload_img();
        get_cart_list();
    })
    function onload_img()
    {
        $('.onloadImg').each(function () {
            if($(this).offset().top<=$(window).scrollTop()+$(window).height() && $(this).attr('src') === default_img){
                $(this).attr('src',$(this).attr('data-src'));
            }
        });
    }
    $(window).scroll(onload_img);
    // article metainfo
    $('#imageMetainfo').on('click', function(){
        $('#metainfoWrapper').toggle();
    });

    //tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // include footer
    //$('.include-footer').load('footer.html');
})();

+function ($) {
    // basic toggle navigation menu

    $('#searchbar').hide();
    $('#buttonCloseSearchbar').hide();

    $('#buttonOpenSearchbar').on('click', function(){
        $('#helpText, #buttonOpenSearchbar').hide();
        $('#searchbar, #buttonCloseSearchbar').removeClass('hide').addClass('show')();
    });

    $('#buttonCloseSearchbar').on('click', function(){
        $('#helpText, #buttonOpenSearchbar').show();
        $('#searchbar, #buttonCloseSearchbar').removeClass('show').addClass('hide');

    });

    $('#buttonOpenSearchbarMobile').on('click', function () {
        $('.fly-searchbar').fadeIn(200);
    });

    $('#buttonCloseSearchbarMobile').on('click', function(){
        $('.fly-searchbar').fadeOut(200);
    });

}(jQuery);


+function ($) {
    // tipue search
    $('#tipue_search_input').tipuesearch();
}(jQuery);

+function ($) {
    // firing owl carousel
    $('.homepage-slider').owlCarousel({
        loop:true,
        margin:0,
        // nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });


    // tags / categories carousel
    $('.small-slider').owlCarousel({
        loop:true,
        margin:10,
        dots:false,
        responsive:{
            0:{
                items:3.5
            },
            600:{
                items:4
            },
            1000:{
                items:8
            }
        }
    });


    // featured channel carousel
    $('.featured-merchant-slider').owlCarousel({
        loop:true,
        margin:10,
        dots:false,
        responsive:{
            0:{
                items:3.5
            },
            600:{
                items:6
            },
            1000:{
                items:12
            }
        }
    });
}(jQuery);
