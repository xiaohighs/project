@extends('layouts.home')

@section('daohang')
<!-- 路径导航 start -->
<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="uppercase mb0">文章列表</h3>
            </div>
            <div class="col-md-6 text-right">
                <ol class="breadcrumb breadcrumb-2">
                    <li>
                        <a href="/">首页</a>
                    </li>
                    <li>
                        <a href="#">文章</a>
                    </li>
                </ol>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
<!-- 路径导航 end -->
@stop


@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-xs-24">
        		@foreach($articles as $k=>$v)
                <div class="post-snippet mb64">
                    <a href="/article/{{$v->id}}">
                        <img class="mb24" alt="Post Image" src="{{$v->pic}}">
                    </a>
                    <div class="post-title">
                        <span class="label">2017-10-04</span>
                        <a href="/article/{{$v->id}}">
                            <h4 class="inline-block">{{$v->title}}</h4>
                        </a>
                    </div>
                </div>
                <hr>
            	@endforeach
                
                <!--end of post snippet-->
                <div class="text-center">
                    {{$articles->links()}}
                </div>
            </div>
            
            <!--end of nine col-->
            <div class="col-md-3 hidden-sm">
                <div class="widget">
                    <h6 class="title">搜索</h6>
                    <hr>
                    <form>
                        <input class="mb0" type="text" placeholder="" />
                    </form>
                </div>
                <!--end of widget-->
                <div class="widget">
                    <h6 class="title">关于作者</h6>
                    <hr>
                    <p>
                    作为全球领先的游戏运营商、研发商,三七互娱不仅积极推动国产游戏的全球化发展;还大力布局以影视音乐、动漫、VR及直播等领域的泛娱乐业务,致力于成为全球领先的互动.
                    </p>
                </div>
                <!--end of widget-->
                <div class="widget">
                    <h6 class="title">文章分类</h6>
                    <hr>
                    <ul class="link-list">
                        @foreach($cates as $k=>$v)
                        <li>
                            <a href="#">{{$v->name}}</a>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <!--end of widget-->
                <div class="widget">
                    <h6 class="title">最近发布</h6>
                    <hr>
                    <ul class="link-list recent-posts">
                        @foreach($recents as $k=>$v)
                        <li>
                            <a href="/article/{{$v->id}}">{{$v->title}}</a>
                            <span class="date">2017-12-04</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--end of sidebar-->
        </div>
        <!--end of container row-->
    </div>
    <!--end of container-->
</section>
@stop