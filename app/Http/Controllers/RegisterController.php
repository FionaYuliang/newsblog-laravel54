<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
class RegisterController extends Controller
{

    //注册页面
    public function index(){
        return view('register.index');
    }

    //注册行为
    public  function register(Request $request){
        //验证
            $this->validate(request(),[
               'name' => 'required|min:3|unique:users,name',
                'email' => 'required|unique:users,email|email',
                'password' => 'required|min:4|max:10|confirmed',
            ]);

        //逻辑
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        //渲染
        return redirect('/login');
    }
}
