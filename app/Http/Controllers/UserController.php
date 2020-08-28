<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){

        // $users = User::all();
        $users = DB::table('users')->paginate(3);
        // dd($users);
        $title = 'Listado de usuarios';
        // dd(compact('title', 'users'));
        /* return view('users')->with('users', $users)->with('title', 'Listado de usuarios'); */
        /* return view('users', [
            'users' => $users,
            'title'=> 'Listado de usuarios'
        ]); */
        
        return view('users.index',compact('title', 'users'));
    }

   
    public function show(User $user){
        // return "Mostrando detalles del usuario --> {$id}";
        // $user = User::findOrFail($user);
        // dd($user);
        /* if ($user == null) {
            # code...
            return responce()->view('errors.404',[],404);
        } */
        return view('users.show',compact('user'));
    }

    public function create()
    {
        return view('users.create', ['title' => 'New User']);
    }
   
    public function store()
    {

        $data =request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required'
        ], [
            'name.required' => 'El campo name es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'password.required' => 'El campo password es obligatorio',
        ]);
        
        //dd($data);


        /* if(empty($data['name'])){
            return redirect('usuarios/nuevo')->withErrors([
                'name' => 'required'
            ]);
        } */

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios');

    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => '',
        ]);

        if($data['password'] != null){
            
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }


        $user->update($data);

        // return redirect("/usuarios/{$user->id}" ,compact("user"));
        // return redirect("/usuarios/{$user->id}" , ['user' => $user]);
        // return redirect()->route('users.show',compact('user'));
        return redirect()->route('users.show',['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect('usuarios');
    }
}
