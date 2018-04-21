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
            ->select('id','title','content','created_at')
            ->orderby('created_at','desc')
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
          $post->title = request('title');
          $post->content = request('content');
          $post->save();

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
    public function update(Request $request){

        //验证
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //逻辑
        $post = new Post();
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //渲染
        return redirect("/posts/{$post->id}");
    }

    //删除逻辑
    public function delete(){

    }
}
