@extends('Admin.main')
@section('title', "首页-Sramer")
@section('body')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>商品列表
                            <small></small>
                        </h5>
                        <div class="ibox-tools">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="{{ url('Admin/Goods/addGoods') }}"><i class="fa fa-plus"></i> 新增</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>商品名称</th>
                                <th>所属分类</th>
                                <th>图片</th>
                                <th>上传时间</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $goods)
                                <tr>
                                    <td class="center">{{ $goods->id }}</td>
                                    <td>{{ $goods->name }}</td>
                                    <td>{{ $permission->category->name }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>
                                        <a class="btn btn-info"><i class="fa fa-edit"></i> 编辑</a>
                                        <a class="btn btn-danger"><i class="fa fa-trash"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>商品名称</th>
                                <th>所属分类</th>
                                <th>图片</th>
                                <th>上传时间</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection