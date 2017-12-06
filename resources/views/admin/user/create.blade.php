@extends('admin.index')

@section('title')
<h1 class="page-header">用户添加</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="/user" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>用户名</label>
                                <input class="form-control" name="username">
                            </div>

                            <div class="form-group">
                                <label>密码</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group">
                                <label>确认密码</label>
                                <input type="password" class="form-control" name="repassword">
                            </div>

                            <div class="form-group">
                                <label>邮箱</label>
                                <input class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>头像</label>
                                <input type="file" class="form-control" name="profile">
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