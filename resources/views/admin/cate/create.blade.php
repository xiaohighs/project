@extends('admin.index')

@section('title')
<h1 class="page-header">分类添加</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="/cate" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>分类名称</label>
                                <input class="form-control" name="name">
                            </div>

                            <div class="form-group">
                                <label>父级分类</label>
                                <select class="form-control" name="pid">
                                    <option value="0">顶级分类</option>
                                    @foreach($cates as $k=>$v)
                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{csrf_field()}}
                            <button type="submit" class="btn btn-default">添加</button>
                            <button type="reset" class="btn btn-default">重置</button>
                        </form>
                    </div>
                    
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection