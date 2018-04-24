@extends("layout.main")

@section('content')
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display: inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>
                @can('update',$post)
                    <a style="margin:auto" href="/posts/{{$post->id}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                @endcan
                @can('delete',$post)
                    <a style="margin:auto" href="/posts/{{$post->id}}/delete">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                @endcan
            </div>

            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}by <a
                        href="#">{{$post->user->name}}</a></p>

            {!!$post->content!!}

            <div>
                @if($post->like(\Auth::id())->exists())
                    <a href="/posts/{{$post->id}}/dislike" type="button" class="btn btn-default btn-sm">取消赞</a>
                @else
                    <a href="/posts/{{$post->id}}/like" type="button" class="btn btn-primary btn-sm">赞</a>
                @endif
            </div>


            <br/>
            <br/>
            <br/>

            <div class="panel panel-default">
                <div class="panel-heading">评论</div>
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <h5>用户 <i>{{$comment->user->name}}</i> 于 <i>{{$comment->created_at}}</i> 发表评论: </h5>
                         <div>
                             {{$comment->content}}
                         </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">发表评论</div>

                <ul class="list-group">
                    <div>
                        <input value="{{$post->id}}" type="hidden" id="post_id">
                        <li class="list-group-item">
                            <textarea name="comment" class="form-control" rows="10"></textarea>
                            <br/>
                            <button id="submit" class="btn btn-default" type="submit">提交</button>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
      $('#submit').on('click', function (ev) {
        let comment = $('textarea[name="comment"]').val()
        let post_id = $('input[id="post_id"]').val()

        $.post('/posts/ajaxComment', {post_id,comment}, function (res) {
          alert('评论成功!')
          location.reload();
        })
        return false
      })
    </script>

@endsection