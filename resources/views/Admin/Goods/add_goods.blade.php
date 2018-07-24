@extends('Admin.main')
@section('title', "首页-Sramer")
@section('css')
    <link href="{{ asset('Admin') }}/css/plugins/chosen/chosen.css" rel="stylesheet">
@endsection()
@section('body')
    <div class="wrapper wrapper-content  animated fadeInRight blog">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>新增商品 <small></small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品分类</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="category_id">
                                        @foreach ($cate_list as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                            @foreach($cate->child as $sec_cate)
                                                <option value="{{ $sec_cate->id }}">&nbsp;&nbsp;&nbsp;&nbsp;{{ $sec_cate->name }}</option>
                                                @foreach($sec_cate->child as $tri_cate)
                                                    <option value="{{ $tri_cate->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $tri_cate->name }}</option>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ $goods_info->name or '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品副标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sub_title" value="{{ $goods_info->sub_title or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标签</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tag" value="{{ $goods_info->tag or '' }}"> <span class="help-block m-b-none">多个标签之间用,分割</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="描述" class="form-control" name="description" value="{{ $goods_info->description or '' }}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">SEO标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="seo_title" value="{{ $goods_info->seo_title or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">SEO关键字</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="seo_keywords" value="{{ $goods_info->seo_keywords or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">SEO描述</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="seo_description" value="{{ $goods_info->seo_description or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" onclick="">属性分类</label>
                                <div class="col-sm-10">
                                    @foreach ($attribute_category_list as $attribute_category)
                                    <label class="checkbox-inline i-checks">
                                        <input type="checkbox" class="attribute_category" value="{{ $attribute_category->id }}">{{ $attribute_category->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            <div id="attribute_label">

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">产品列表</label>
                                <div class="col-sm-10 product_list">
                                    <button class="btn btn-info btn-sm" onclick="">批量生成产品</button>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">商品详情</label>
                                @include('vendor.UEditor.head')
                                <div class="col-sm-10"><script id="container" name="detail" type="text/plain" style="width:1024px;height:500px;">{!! isset($goods_info->detail) ? html_entity_decode($goods_info->detail) : '' !!}</script></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sort" value="{{ $goods_info->sort or '' }}"> <span class="help-block m-b-none"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <input type="checkbox" id="status" name="status"
                                        @if(isset($goods_info->status))
                                            @if($goods_info->status == 1)
                                                'checked'
                                            @endif
                                        @endif
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                </div>
                            </div>
                        </form>
                        <!-- Modal -->
                        <div class="modal fade" id="selectAttributes" tabindex="-1" role="dialog" aria-labelledby="selectAttributesLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">选择属性</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">商品标题</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" value="{{ $goods_info->name or '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">商品副标题</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="sub_title" value="{{ $goods_info->sub_title or '' }}"> <span class="help-block m-b-none"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('Admin') }}/js/plugins/chosen/chosen.jquery.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function(){
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });
    </script>
    <script type="text/javascript">
        /**
         * 模拟淘宝SKU添加组合
         * 页面注意事项：
         *      1、 .Father_Title      这个类作用是取到所有标题的值，赋给表格，如有改变JS也应相应改动
         *      2、 .Father_Item       这个类作用是取类型组数，有多少类型就添加相应的类名：如: Father_Item1、Father_Item2、Father_Item3 ...
         */
        $(function() {
            $(document).on('change', '.choose_config label', function() {
                var parent=$(this).parents('.Father_Item');
                var _this=$('.checkbox',this);
                // 是否全选
                $('.checkbox',parent).each(function() {
                    var bCheck2=true;
                    if (_this.hasClass('check_all')) {
                        if (_this.get(0).checked) {
                            bCheck2=true;
                            $('.check_item',parent).prop('checked', bCheck2);
                        }else{
                            bCheck2=false;
                            $('.check_item',parent).prop('checked', bCheck2);
                        }
                        return false;
                    } else {
                        if ((!this.checked)&&(!$(this).hasClass('check_all'))) {
                            bCheck2 = false;
                            $('.check_all',parent).prop('checked', bCheck2);
                            return false;
                        }
                    }
                    $('.check_all',parent).prop('checked', bCheck2);
                });

                step.Creat_Table();
            });
            var step = {
                // 信息组合
                Creat_Table: function() {
                    step.hebingFunction();
                    var SKUObj = $('.Father_Title');
                    var arrayTile = new Array(); // 表格标题数组
                    var arrayInfor = new Array(); // 盛放每组选中的CheckBox值的对象
                    var arrayColumn = new Array(); // 指定列，用来合并哪些列
                    var bCheck = true; // 是否全选，只有全选，表格才会生成
                    var columnIndex = 0;

                    $.each(SKUObj, function(i, item) {
                        arrayColumn.push(columnIndex++);
                        arrayTile.push(SKUObj.eq(i).text().replace('：', ''));
                        var itemName = '.Father_Item' + i;
                        var bCheck2 = true; // 是否全选

                        // 获取选中的checkbox的值
                        var order = new Array();
                        $(itemName + ' .check_item:checked').each(function() {
                            order.push($(this).val());
                        });

                        arrayInfor.push(order);
                        if (order.join() == '') {
                            bCheck = false;
                        }
                    })

                    // 开始生成表格
                    if (bCheck) {
                        $('#createTable').html('');
                        var table = $('<table id="process" class="columnList"></table>');
                        table.appendTo($('#createTable'));
                        var thead = $('<thead></thead>');
                        thead.appendTo(table);
                        var trHead = $('<tr></tr>');
                        trHead.appendTo(thead);
                        // 创建表头
                        var str = '';
                        $.each(arrayTile, function(index, item) {
                            str += '<th width="100">' + item + '</th>';
                        })
                        str += '<th  width="200">价格</th><th width="100">操作</th>';
                        trHead.append(str);
                        var tbody = $('<tbody></tbody>');
                        tbody.appendTo(table);

                        var zuheDate = step.doExchange(arrayInfor);
                        if (zuheDate.length > 0) {
                            //创建行
                            $.each(zuheDate, function(index, item) {
                                var td_array = item.split(',');
                                var tr = $('<tr></tr>');
                                tr.appendTo(tbody);
                                var str = '';
                                $.each(td_array, function(i, values) {
                                    str += '<td>' + values + '</td>';
                                });
                                str += '<td ><input name="Txt_PriceSon" class="inpbox inpbox-mini" type="text"></td>';
                                str += '<td ><a href="#">删除</a></td>';
                                tr.append(str);
                            });
                        }

                        //结束创建Table表
                        arrayColumn.pop(); //删除数组中最后一项
                        //合并单元格
                        $(table).mergeCell({
                            // 目前只有cols这么一个配置项, 用数组表示列的索引,从0开始
                            cols: arrayColumn
                        });
                    } else {
                        //未全选中,清除表格
                        document.getElementById('createTable').innerHTML = "";
                    }
                },
                hebingFunction: function() {
                    $.fn.mergeCell = function(options) {
                        return this.each(function() {
                            var cols = options.cols;
                            for (var i = cols.length - 1; cols[i] != undefined; i--) {
                                mergeCell($(this), cols[i]);
                            }
                            dispose($(this));
                        })
                    };

                    function mergeCell($table, colIndex) {
                        $table.data('col-content', ''); // 存放单元格内容
                        $table.data('col-rowspan', 1); // 存放计算的rowspan值 默认为1
                        $table.data('col-td', $()); // 存放发现的第一个与前一行比较结果不同td(jQuery封装过的), 默认一个"空"的jquery对象
                        $table.data('trNum', $('tbody tr', $table).length); // 要处理表格的总行数, 用于最后一行做特殊处理时进行判断之用
                        // 进行"扫面"处理 关键是定位col-td, 和其对应的rowspan
                        $('tbody tr', $table).each(function(index) {
                            // td:eq中的colIndex即列索引
                            var $td = $('td:eq(' + colIndex + ')', this);
                            // 获取单元格的当前内容
                            var currentContent = $td.html();
                            // 第一次时走次分支
                            if ($table.data('col-content') == '') {
                                $table.data('col-content', currentContent);
                                $table.data('col-td', $td);
                            } else {
                                // 上一行与当前行内容相同
                                if ($table.data('col-content') == currentContent) {
                                    // 上一行与当前行内容相同则col-rowspan累加, 保存新值
                                    var rowspan = $table.data('col-rowspan') + 1;
                                    $table.data('col-rowspan', rowspan);
                                    // 值得注意的是 如果用了$td.remove()就会对其他列的处理造成影响
                                    $td.hide();
                                    // 最后一行的情况比较特殊一点
                                    // 比如最后2行 td中的内容是一样的, 那么到最后一行就应该把此时的col-td里保存的td设置rowspan
                                    // 最后一行不会向下判断是否有不同的内容
                                    if (++index == $table.data('trNum'))
                                        $table.data('col-td').attr('rowspan', $table.data('col-rowspan'));
                                }
                                // 上一行与当前行内容不同
                                else {
                                    // col-rowspan默认为1, 如果统计出的col-rowspan没有变化, 不处理
                                    if ($table.data('col-rowspan') != 1) {
                                        $table.data('col-td').attr('rowspan', $table.data('col-rowspan'));
                                    }
                                    // 保存第一次出现不同内容的td, 和其内容, 重置col-rowspan
                                    $table.data('col-td', $td);
                                    $table.data('col-content', $td.html());
                                    $table.data('col-rowspan', 1);
                                }
                            }
                        })
                    }
                    // 同样是个private函数 清理内存之用
                    function dispose($table) {
                        $table.removeData();
                    }
                },
                doExchange: function(doubleArrays) {
                    // 二维数组，最先两个数组组合成一个数组，与后边的数组组成新的数组，依次类推，知道二维数组变成以为数组，所有数据两两组合
                    var len = doubleArrays.length;
                    if (len >= 2) {
                        var arr1 = doubleArrays[0];
                        var arr2 = doubleArrays[1];
                        var len1 = arr1.length;
                        var len2 = arr2.length;
                        var newLen = len1 * len2;
                        var temp = new Array(newLen);
                        var index = 0;
                        for (var i = 0; i < len1; i++) {
                            for (var j = 0; j < len2; j++) {
                                temp[index++] = arr1[i] + ',' + arr2[j];
                            }
                        }
                        var newArray = new Array(len - 1);
                        newArray[0] = temp;
                        if (len > 2) {
                            var _count = 1;
                            for (var i = 2; i < len; i++) {
                                newArray[_count++] = doubleArrays[i];
                            }
                        }
                        return step.doExchange(newArray);
                    } else {
                        return doubleArrays[0];
                    }
                }
            }
        })
    </script>
    <script>
        var config = {
            ".chosen-select": {},
            ".chosen-select-deselect": {allow_single_deselect: !0},
            ".chosen-select-no-single": {disable_search_threshold: 10},
            ".chosen-select-no-results": {no_results_text: "Oops, nothing found!"},
            ".chosen-select-width": {width: "95%"}
        };
        for (var selector in config)$(selector).chosen(config[selector]);
        $('input').on('ifChecked', function(event){
            var type = event.target.className;
            var value = event.target.value;
            if (type == 'attribute_category')
            {
                var URL = '{{ url('Admin/Ajax/getAttributesList') }}';
                var data = {id:event.target.value};
                $.post(URL,data,function (result) {
                    var html = '<div class="form-group '+type+'_'+value+'">\n' +
                        '                                    <label class="col-sm-2 control-label" onclick="">'+result.data.name+'</label>\n' +
                        '                                    <div class="col-sm-10">\n' +
                        '                                        <div class="input-group">\n' +
                        '                                            <select data-placeholder="选择'+result.data.name+'" class="chosen-select" multiple style="width:350px;"\n' +
                        '                                                    tabindex="4">\n';
                    for (var x in result.data.attributes) html += '<option value="'+result.data.attributes[x]['id']+'">['+result.data.attributes[x]['value_code']+']   '+result.data.attributes[x]['value']+'</option>';
                    html +=                         '                                            </select>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                    $('#attribute_label').append(html);
                    $('.chosen-select').chosen(config['.chosen-select']);
                });
            }
        });
        $('input').on('ifUnchecked', function(event){
            var type = event.target.className;
            var value = event.target.value;
            $('.'+type+'_'+value).remove();
        });
    </script>
@endsection