@extends('admin.index')

@section('title')
<h1 class="page-header">用户修改</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="/user/{{$user->id}}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>用户名</label>
                                <input class="form-control" name="username" value="{{$user->username}}">
                            </div>


                            <div class="form-group">
                                <label>邮箱</label>
                                <input class="form-control" name="email" value="{{$user->email}}">
                            </div>

                            <div class="form-group">
                                <img src="{{$user->profile}}" alt="" width="200">
                                <hr>
                                <label>头像</label>
                                <input type="file" class="form-control" name="profile">
                            </div>
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <button type="submit" class="btn btn-default">更新</button>
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