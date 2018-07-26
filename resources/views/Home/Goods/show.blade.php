@extends('Home.app')
@section('title', "$goods->name  -Sramer")
@section('css')
    <style type="text/css">
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0;
        }
        ul,li{ padding:0px; margin:0px;}
        #panel{ width:500px; margin:30px auto;}


        .goods_attr{ overflow:hidden;}
        .goods_attr .label {font: 12px/30px '宋体';color: #777;width: 50px;;padding-right: 10px;float: left; display:block;}
        .goods_attr ul {float:left;width:300px;}

        .goods_attr li{color:#333;overflow:hidden;position:relative;float:left;text-align:center; vertical-align:middle; border:1px solid #999;text-indent:0; cursor:pointer}
        .goods_attr li.b{border:1px dotted #CCC;color:#DDD; pointer:none;}
        .goods_attr li.b img {opacity:0.4;}
        .goods_attr li.sel{ border:1px solid #c80a28;color:#333;}

        .goods_attr li.text{margin:5px 10px 5px 0; height:23px;line-height:23px;text-indent:0;padding:0 23px;font-style:normal;}
        .goods_attr li.img{ margin-right:10px;width:35px;height:35px; line-height:35px;text-align:center;}
    </style>
@endsection
@section('body')
    <div class="container kimi-container">
        <ol class="breadcrumb hidden-xs">
            <li><a href="{{ url('/') }}">Home</a></li>
            @foreach($goods_category as $item)
            <li><a href="{{ url('/category',['id'=>$item->id]) }}">{{ $item->name }}</a></li>
            @endforeach
            <li>{{ $goods->name }}</li>
        </ol>
    </div>

    <div class="container" style="background: white; padding-bottom: 50px;">
        <div class="col-md-6">
            <!--carousel-->
            <div id="main_area">
                <!-- Slider -->
                <div class="row" style="margin-top: 25px;">

                    <div class="col-sm-9 less-padding">
                        <div class="col-xs-12 less-padding" id="slider">
                            <!-- Top part of the slider -->
                            <div class="row">
                                <div class="col-sm-12" id="carousel-bounding-box">
                                    <div class="carousel slide" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <div class="active item" data-slide-number="0">
                                                <img src="{{ $goods->picture }}">
                                            </div>
                                            @foreach ($goods->pictures as $key => $picture)
                                            <div class="item" data-slide-number="{{ $key+1 }}">
                                                <img src="{{ $picture->url }}">
                                            </div>
                                            @endforeach
                                        </div>
                                        <!-- Carousel nav -->
                                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Slider-->

                    <div class="col-sm-3" id="slider-thumbs">
                        <a class="thumbnail" id="carousel-selector-0">
                            <img src="{{ $goods->picture }}">
                        </a>
                        @foreach ($goods->pictures as $key => $picture)
                        <a class="thumbnail" id="carousel-selector-{{ $key+1 }}">
                            <img src="{{ $picture->url }}">
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
            <!--carousel ends-->
        </div>

        <div class="col-md-6" style="position: relative;">
            <div class="bookmarked"><img src="{{asset('Home')}}/images/bookmarked.png" width="86"> </div>
            <h1>{{ $goods->name }}</h1>

            {{--<div class="row">
                <div class="col-md-10">
                    <a href="channelDetail.html" class="text-secondary"><h4>By Sucicakes</h4></a>
                    <h4>Location: Kebon Jeruk, Jakarta Barat</h4>
                </div>
                <div class="col-md-2"><img src="{{asset('Home')}}/images/halal.png" width="60"> </div>
            </div>--}}


            <p class="product-description">{{ $goods->sub_title }}</p>
            <p class="product-description">Min-order: 10 pcs</p>

            <div class="product-detail-tag-container">
                <div id="panel">
                    <div id="panel_sel">

                    </div>

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <h3>价格 ¥<span id="price">{{ $goods->min_price }}</span></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" style="padding-top: 18px;">
                    <p class="pull-left" style="line-height: 35px; margin-right: 20px;">Quantity</p>
                        <div class="form-group pull-left"><button class="btn btn-default" id="quantity_dec" onclick="quantity_dec()">-</button></div>
                        <div class="form-group pull-left">
                            <input type="number" class="form-control number-input" id="quantity" name="quantity" value="1" style="width: 60px; border: none; font-weight: bold; font-size: 20px;" min="1" max="1">
                        </div>
                        <div class="form-group"><button class="btn btn-default" id="quantity_inc" onclick="quantity_inc()">+</button></div>
                    <p>(剩余库存: <span id="stock">0</span> )</p>
                    <input type="hidden" id="product_id" value="0">
                </div>
            </div>

            <div class="product-detail-action-button-container">
                <button onclick="add_cart()" class="btn button-add-to-bag" style="margin-right: 10px;">{{ __('Home/common.add_to_cart') }}</button>
                <button class="btn btn-default button-black button-learn-more" id="bookmarkButton">{{ __('Home/common.set_favourite') }}</button>
                <button class="btn btn-default button-black button-learn-more" id="deleteBookmarkButton" style="display: none;">{{ __('Home/common.delete_favourite') }}</button>
            </div>


        </div>
    </div><!-- /.container -->

    <div class="container" style="background: white; padding-bottom: 50px;">
        {!! $goods->detail !!}
    </div>
@endsection
@section('javascript')
    <script>
        jQuery(document).ready(function($) {

            // bookmark
            $('.bookmarked').hide();


            $('#bookmarkButton').on('click', function () {
                $('.bookmarked').fadeIn(200);
                $('#bookmarkButton').hide();
                $('#deleteBookmarkButton').show();
            });



            // Delete bookmark

            $('#deleteBookmarkButton').on('click', function () {
                $('.bookmarked').fadeOut(200);
                $('#bookmarkButton').show();
                $('#deleteBookmarkButton').hide();
            });


            $('#myCarousel').carousel({
                interval: 5000
            });

            //Handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function () {
                var id_selector = $(this).attr("id");
                try {
                    var id = /-(\d+)$/.exec(id_selector)[1];
                    console.log(id_selector, id);
                    jQuery('#myCarousel').carousel(parseInt(id));
                } catch (e) {
                    console.log('Regex failed!', e);
                }
            });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function (e) {
                var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
            });
        });
    </script>
    <script type="text/javascript">
        /*
        属性集
        */
        var keys = {
            @foreach($attribute_list as $key => $attribute)
                '{{ $key }}' : [
                    @foreach ($attribute as $item)
                        '{{ $item }}',
                    @endforeach ],
            @endforeach
        };
        //SKU，Stock Keeping Uint(库存量单位)
        var sku_list=[
            @foreach($goods->products as $product)
                {'id':'{{$product->id}}','num':'{{$product->stock}}','price':'{{$product->price}}','attrs':'{{$product->attribute_string}}'},
            @endforeach
        ];


        /**init start */

        //显示html结构
        function show_attr_item(){
            var html='';
            for(k in keys){
                html+='<div class="goods_attr" > <span class="label">'+k+'</span>';
                html+='<ul>'
                for(k2 in keys[k]){
                    _attr_id=keys[k][k2];
                    html+='<li class="text" val="'+_attr_id+'" >';
                    html+='<span>'+_attr_id+'</span>';
                    html+='<s></s>';
                    html+='</li>'
                }
                html+='</ul>';
                html+='</div>';
            }
            $('#panel_sel').html(html);
        }
        show_attr_item()

        /**init end */

        //获取所有包含指定节点的路线
        function filterProduct(ids){
            var result=[];
            $(sku_list).each(function(k,v){
                _attr='|'+v['attrs']+'|';
                _all_ids_in=true;
                for( k in ids){
                    if(_attr.indexOf('|'+ids[k]+'|')==-1){
                        _all_ids_in=false;
                        break;
                    }
                }
                if(_all_ids_in){
                    result.push(v);
                }

            });
            return result;
        }

        //获取 经过已选节点 所有线路上的全部节点
        // 根据已经选择得属性值，得到余下还能选择的属性值
        function filterAttrs(ids){
            var products=filterProduct(ids);
            //console.log(products);
            var result=[];
            $(products).each(function(k,v){
                result=result.concat(v['attrs'].split('|'));

            });
            return result;
        }

        function getItemByAttr(attr)
        {
            var item = [];
            sku_list.forEach(function(k,v){
                if (attr == k['attrs'])
                {
                    item = k;
                }
            });
            return item;
        }

        function change_stock_and_price(attr)
        {
            var item = getItemByAttr(attr);
            //console.log(attr+' '+item);
            if (item['id'])
            {
                $('#stock').html(item['num']);
                $('#price').html(item['price']);
                $('#product_id').val(item['id']);
                $('#quantity').attr('max',item['num']);
                $('#quantity').val(1);
            }
        }

        //已选择的节点数组
        function _getSelAttrId(){

            var list=[];
            $('.goods_attr li.sel').each(function(){
                list.push($(this).attr('val'));
            });
            return list;
        }

        $('#quantity').on('input',function (){
            $(this).val()>$(this).attr('max')*1?$(this).val($(this).attr('max')*1):$(this).val();
            $(this).val()<$(this).attr('min')*1?$(this).val($(this).attr('min')*1):$(this).val();
        });

        function quantity_dec()
        {
            var quantity_num = $('#quantity').val();
            if (quantity_num > $('#quantity').attr('min')*1)
            {
                var num = quantity_num*1-1;
                $('#quantity').val(num);
            }
        }

        function quantity_inc()
        {
            var quantity_num = $('#quantity').val();
            if (quantity_num < $('#quantity').attr('max')*1)
            {
                var num = quantity_num*1+1;
                $('#quantity').val(num);
            }
        }

        $('.goods_attr li').click(function(){
            if($(this).hasClass('b')){
                return ;//被锁定了
            }
            if($(this).hasClass('sel')){
                $(this).removeClass('sel');
            }else{
                $(this).siblings().removeClass('sel');
                $(this).addClass('sel');

            }
            var select_ids=_getSelAttrId();
            var select_attr_string = select_ids.join('|');
            change_stock_and_price(select_attr_string);



            //已经选择了的规格
            var $_sel_goods_attr=$('li.sel').parents('.goods_attr');

            // step 1
            var all_ids=filterAttrs(select_ids);

            //获取未选择的
            var $other_notsel_attr=$('.goods_attr').not($_sel_goods_attr);

            //设置为选择属性中的不可选节点
            $other_notsel_attr.each(function(){
                set_block($(this),all_ids);

            });

            //step 2
            //设置已选节点的同级节点是否可选
            $_sel_goods_attr.each(function(){
                update_2($(this));
            });


        });

        function update_2($goods_attr){
            // 若该属性值 $li 是未选中状态的话，设置同级的其他属性是否可选
            var select_ids=_getSelAttrId();
            var $li=$goods_attr.find('li.sel');

            var select_ids2=del_array_val(select_ids,$li.attr('val'));

            var all_ids=filterAttrs(select_ids2);

            set_block($goods_attr,all_ids);
        }

        function set_block($goods_attr,all_ids){
            //根据 $goods_attr下的所有节点是否在可选节点中（all_ids） 来设置可选状态
            $goods_attr.find('li').each(function(k2,li2){

                if($.inArray($(li2).attr('val'),all_ids)==-1){
                    $(li2).addClass('b');
                }else{
                    $(li2).removeClass('b');
                }

            });

        }
        function del_array_val(arr,val){
            //去除 数组 arr中的 val ，返回一个新数组
            var a=[];
            for(k in arr){
                if(arr[k]!=val){
                    a.push(arr[k]);
                }
            }
            return a;
        }
    </script>
    <script>
        function add_cart()
        {
            var id = $("#product_id").val();
            var qty = $("#quantity").val();
            var data = {'id':id,'qty':qty};
            var url = '{{ url('/Cart/add') }}';
            $.post(url,data,function(result){
                if (result.status == 200)
                {
                    get_cart_list();
                }
            },'json');
        }
    </script>
@endsection