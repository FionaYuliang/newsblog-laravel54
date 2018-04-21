@extends("layout.main")

@section('content')
 <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display: inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>

                <a style="margin:auto" href="/posts/{{$post->id}}/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a style="margin:auto" href="/posts/{{$post->id}}/delete">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
            </div>

            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}by <a href="#">lihuayuliang</a></p>

            {!!$post->content!!}

            <div>
                <a href="/posts/{{$post->id}}/praise" type="button" class="btn btn-primary btn-sm">赞</a>
            </div>

        <br/>
        <br/>
        <br/>

        <div class="panel panel-default">
            <div class="panel-heading">评论</div>
           <ul class="list-group">

           </ul>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">发表评论</div>
            <div class="panel-body">
                <form>
                <textarea>

                </textarea>
                    <br/>
                    <button class="btn btn-primary" type="submit" name="提交">提交</button>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection