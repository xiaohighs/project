@extends('admin.index')

@section('title')
<h1 class="page-header">文章添加</h1>
@endsection

@section('content')
<script type="text/javascript" charset="utf-8" src="/plugins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/plugins/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="/article" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>文章标题</label>
                                <input class="form-control" name="title">
                            </div>


                            <div class="form-group">
                                <label>文章头图</label>
                                <input type="file" class="form-control" name="pic">
                            </div>
                            
                            <div class="form-group">
                                <label>文章内容</label>
                                <script id="editor" type="text/plain" name="content" style="width:1024px;height:500px;"></script>

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

<script>
    var ue = UE.getEditor('editor',{
        // toolbars: [
        //     ['fullscreen', 'source', 'undo', 'redo', 'bold']
        // ]
    });
</script>
@endsection