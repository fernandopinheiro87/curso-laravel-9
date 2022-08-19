<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request){



        $search = $request->search;
        $users = $this->model->getUsers(search: $request->search ??'');
        //dd($users);
        
        //formas de passar variavel para a view
        //1)
        /*
        return view('users/index', [
            'users' => $users
        ]);
        */
        // 2)
        return view('users/index', compact('users'));
    }

    public function show($id){
        //return view('users/index');
        //dd("teste");
       // $user = User::where('id',$id)->first();
        //dd($user);
        //$user = User::find($id);
        //dd($user);
        
        if(!$user = User::find($id)){
            //return redirect()->back();
            return redirect()->route('users.index');
        }
        
       // dd($user);
        return view('users/show',compact('user'));
    }

    public function create(){
        return view('users/create');
    }

    public function store(StoreUpdateUserFormRequest $request){
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
 
        //dd( $request->image);
        if($request->image){
            $data['image'] = $request->image->store('users');
            /*
            $extension = $request->image->getClientOriginalExtension();
            $data['image'] = $request->image->storeAs('users', now() . ".{$extension}");
            */
        }
        User::create($data);

        //return redirect()->route('users/show', $user->id);
        return redirect()->route('users/index');
    }

    public function edit($id){
        
        if(!$user = User::find($id)){
            //return redirect()->back();
            return redirect()->route('users.index');
        }

        return view('users/edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id){
        
        if(!$user = User::find($id)){
            //return redirect()->back();
            return redirect()->route('users.index');
        }

        $data = $request->only('name', 'email');
        if($request->password)
            $data['password']  = bcrypt($request->password);

        
        if($request->image){
            if($user->image && Storage::exists($user->image)){
                Storage::delete($user->image);
            }
            $data['image'] = $request->image->store('users');
        }


        $user->update($data);

        return redirect()->route('users/index');
    }

    public function delete($id){
        
        if(!$user = User::find($id)){
            //return redirect()->back();
            return redirect()->route('users.index');
        }

        $user->delete();

        return redirect()->route('users/index');
    }

}
