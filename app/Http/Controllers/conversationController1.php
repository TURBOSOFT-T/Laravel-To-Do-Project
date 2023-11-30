<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{

private $r;
private $auth;
    public function __construct( ConversationRepository $conversationRepository,AuthManager $auth){
        $this->r= $conversationRepository;
        $this->auth=$auth;

    }
    public function index()
    {
        $users=User::all();
     // $users=User:: select('name', 'id','!=', Auth::user()->id)->get();
    // $users=User::select('name','id')->where('id','!=', Auth::user()->id)->get();
        return view('conversations.index',[
            'users'=>$this->r->getConversations($this->auth->user()->id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( User $user)
    {
        $users=User::all();
        // $users=User:: select('name', 'id','!=', Auth::user()->id)->get();
       // $users=User::select('name','id')->where('id','!=', Auth::user()->id)->get();
           return view('conversations.show',[
            'users'=>$this->r->getConversations($this->auth->user()->id),
            'user'=>$user

           ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
