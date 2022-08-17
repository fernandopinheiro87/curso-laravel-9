<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Http\Requests\StoreUpdateCommentRequest;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    protected $comment;
    protected $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    public function index(Request $request, $userId){



         $this->user = $userId;

        if(!$user = User::find($userId)){
            return redirect()->back();
        }

        $comments = $user->comments()->where('body', 'LIKE', "%{$request->search}%")->get();
        
        return view('users.comments.index', compact('user','comments'));
    }

    public function create($userId){

        $this->user = $userId;

        if(!$user = User::find($userId)){
            return redirect()->back();
        }
        
        return view('users.comments.create', compact('user'));
    }

    public function store(StoreUpdateCommentRequest $request, $userId){
        
        if(!$user = User::find($userId)){
            return redirect()->back();
        }

        //$user->comments()->create($request->all());
        // $this->comment->create([
        //    'user_id'
        // ]);

        //User::create($data);

        //return redirect()->route('users/show', $user->id);

        $user->comments()->create([
            'body' => $request->body,
            'visible' => isset($request->visible)
        ]);


        return redirect()->route('comments/index',$user->id);
    }


    public function edit($userId, $id){
        
        if(!$comment = $this->comment->find($id)){
            return redirect()->back();
        }

        $user = $comment->user;

        return view('users.comments.edit', compact('user', 'comment'));
    }

    public function update(StoreUpdateCommentRequest $request, $id){
        
        if(!$comment = $this->comment->find($id)){
            return redirect()->back();
        }

        //$user->comments()->create($request->all());
        // $this->comment->create([
        //    'user_id'
        // ]);

        //User::create($data);

        //return redirect()->route('users/show', $user->id);

        $comment->update([
            'body' => $request->body,
            'visible' => isset($request->visible)
        ]);


        return redirect()->route('comments/index',$comment->user_id);
    }


}
