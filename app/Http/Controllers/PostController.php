<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Post;


class PostController extends Controller
{

    public function index()
    {
        $posts = Post::query()
            ->join('users','users.id','=','posts.user_id')
            ->select('users.id as uid','users.name as user_name','posts.id','posts.title','posts.content','posts.created_at')
            ->orderby('posts.created_at','desc')
            ->paginate(6);

        return view('posts/index', compact('posts'));


    }


    //文章详情页
    public function show(Post $post){


        return view('posts/show',compact('post'));
    }

    //创建文章
    public function create(){

        return view('posts/create');
    }

    //创建逻辑
    public function store(Request $request){


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

          return [234];
        //渲染
        return redirect('/posts');

    }
      public  function imageUpload(){

        dd(request()->all());

      }

    //编辑文章
    public function edit(Post $post){

        return view('posts/edit',compact('post'));
    }

    //编辑逻辑
    public function update(Post $post){

        //验证
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $this->authorize('update',$post);

        //逻辑
        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}");
    }

    //删除逻辑
    public function delete(Post $post){
        $this->authorize('delete',$post);
    }
}
