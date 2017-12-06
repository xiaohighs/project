@extends('layouts.home')

@section('daohang')
<!-- 路径导航 start -->
<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="uppercase mb0">文章详情</h3>
            </div>
            <div class="col-md-6 text-right">
                <ol class="breadcrumb breadcrumb-2">
                    <li>
                        <a href="/">首页</a>
                    </li>
                    <li>
                        <a href="#">文章</a>
                    </li>
                    <li class="active">{{ $article->title }}</li>
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
                <div class="post-snippet mb64">
                    <img class="mb24" alt="Post Image" src="{{$article->pic}}" />
                    <div class="post-title">
                        <span class="label">2017-10-20</span>
                        <h4 class="inline-block">{{$article->title}}</h4>
                    </div>
                    <ul class="post-meta">
                        <li>
                            <i class="ti-user"></i>
                            <span>
                                <a href="#">xiaohigh</a>
                            </span>
                        </li>
                        
                    </ul>
                    <hr>
                    {!! $article->content !!}
                </div>
                <!--end of post snippet-->
                <hr>
               <!--  <div class="comments">
                    <h5 class="uppercase">3 Comments</h5>
                    <ul class="comments-list">
                        <li>
                            <div class="avatar">
                                <img alt="Avatar" src="/home/img/avatar1.png" />
                            </div>
                            <div class="comment">
                                <span class="uppercase author">Jane Lovell, September 8</span>
                                <a class="btn btn-sm" href="#">Reply</a>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                            <ul>
                                <li>
                                    <div class="avatar">
                                        <img alt="Avatar" src="/home/img/avatar2.png" />
                                    </div>
                                    <div class="comment">
                                        <span class="uppercase author">Tim Jackson, September 8</span>
                                        <a class="btn btn-sm" href="#">Reply</a>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="avatar">
                                <img alt="Avatar" src="/home/img/avatar3.png" />
                            </div>
                            <div class="comment">
                                <span class="uppercase author">Roland Sims, September 9</span>
                                <a class="btn btn-sm" href="#">Reply</a>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <hr>
                    <h5 class="uppercase">Leave A Comment</h5>
                    <form>
                        <input name="name" type="text" placeholder="Your Name" />
                        <input name="email" type="text" placeholder="Email Address" />
                        <textarea rows="3" placeholder="Comment"></textarea>
                        <input type="submit" value="Leave Comment" />
                    </form>
                </div> -->
                <!--end of comments-->
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

@section('title')
<title>{{$article->title}} - 文章详情 - 张家口职业学院</title>
@show