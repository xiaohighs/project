@extends('admin.index') @section('title')
<h1 class="page-header">文章列表</h1> @endsection @section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                	<form action="/article">
	                    <div class="row">
	                        <div class="col-sm-6">
	                            <div class="dataTables_length" id="dataTables-example_length">
	                                <label>每页显示
	                                    <select name="num" aria-controls="dataTables-example" class="form-control input-sm">
	                                        <option value="10" @if($num == 10) selected @endif>10</option>
	                                        <option value="25" @if($num == 25) selected @endif>25</option>
	                                        <option value="50" @if($num == 50) selected @endif>50</option>
	                                        <option value="100" @if($num == 100) selected @endif>100</option>
	                                    </select> 条</label>
	                            </div>
	                        </div>
	                        <div class="col-sm-6 text-right">
	                            <div id="dataTables-example_filter" class="dataTables_filter">
	                                <label>关键字:
	                                    <input type="search" value="{{$keywords}}" name="keywords" class="form-control input-sm" placeholder="" aria-controls="dataTables-example">&nbsp;<button type="submit" class="btn btn-sm btn-info">搜索</button>
	                                </label>
	                            </div>
	                        </div>
	                    </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 185px;">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 224px;">标题</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 161px;">头图</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 121px;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@if(count($articles) > 0)
	                                	@foreach($articles as $k=>$v)
	                                    <tr class="gradeA odd" role="row">
	                                        <td class="sorting_1">{{$v->id}}</td>
	                                        <td>{{$v->title}}</td>
	                                        <td class="center"><img width="20" src="{{$v->pic}}" alt=""></td>
	                                        <td class="center">
	                                        	<a class="btn btn-info btn-sm pull-left" href="/article/{{$v->id}}/edit">修改</a>
                                                <form class="del" action="/article/{{$v->id}}" method="post">
                                                {{method_field('DELETE')}}
                                                {{csrf_field()}}
												<button class="btn btn-danger btn-sm">删除</button>	
                                                </form>
	                                        </td>
	                                    </tr>
	                                    @endforeach
                                    @else
                                    <tr><td colspan="5" class="text-center">暂无数据</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                {{ $articles->appends(['num'=>$num, 'keywords'=>$keywords])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection


@section('js')
<script>
$('.del').submit(function(e){
    if(!confirm('您确定要删除该文章么?')) return false;
});
</script>
@endsection
