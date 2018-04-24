<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Comment;
use App\Like;
use App\User;
use Mockery\Exception;

use App\Http\Controllers\LoginController;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::query()
            ->join('users','users.id','=','posts.user_id')
            ->select('users.id as uid','users.name as user_name','posts.id','posts.title','posts.content','posts.created_at')
            ->orderby('posts.created_at','desc')
            ->withCount(['comments','likes'])
            ->paginate(6);

        return view('posts/index', compact('posts'));


    }


    //文章详情页
    public function show(Post $post)
    {
        //预先加载comments,这样Views层不做数据查询,只做渲染
        $post->load('comments');

        return view('posts/show',compact('post'));
    }

    //创建文章
    public function create()
    {
        return view('posts/create');
    }

    //创建逻辑
    public function store(Request $request)
    {
//        $posts = ['title'=> request('title'),'content'=>request('content')];
//        $posts = request(['title', 'content']);
//         Post::create($posts);
//
 //         Post::create(request(['title','content']));
//

         //验证
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //逻辑
          $post = new Post();
          $user_id = \Auth::id();
          $post->title = request('title');
          $post->content = request('content');
          $post->user_id = $user_id;
        $post->save();
//          $param = array_merge(request(['title','content']),compact('user_id'));
//          $param->save();

        //渲染
        return redirect('/posts');

    }
      public  function imageUpload()
      {

        dd(request()->all());

      }

    //编辑文章
    public function edit(Post $post)
    {
        return view('posts/edit',compact('post'));
    }

    //编辑逻辑
    public function update(Post $post)
    {

        //验证
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);


        try {
            $this->authorize('update', $post);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

        }

        //逻辑
        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}");
    }

    //删除逻辑
    public function delete(Post $post)
    {

        try {
            $this->authorize('delete', $post);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

        }
    }

    //提交评论
    public function comment(Post $post)
    {

        $this->validate(request(),[
                'comment'=> 'required|min:3',
        ]);

        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('comment');
        $comment->post_id = request('post_id');
        //插入数据不需要模型关联!
        $comment->save();

        //return back();

    }

    public function like(Post $post)
    {
        $like = Like::firstOrCreate(
           [ 'user_id' => \Auth::id()],['post_id' => $post->id]
        );

        return back();
    }


    public function dislike(Post $post)
    {
       $post->like(\Auth::id())->delete();

       return back();
    }
}
