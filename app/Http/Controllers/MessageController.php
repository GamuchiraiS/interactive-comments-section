<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function index()
    {
        //get messages
        $messages = Message::all();
        return view('messages.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $newMessage = new Message;
        $newMessage->message = $request->message;
        $newMessage->vote_count = 0;
        $newMessage->save();

//        Message::create([
//            'message'    => $request->message,
//            'vote_count'
//        ]);

        //$request->user->messages()->created->($validated);
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return Application|\Illuminate\Contracts\View\Factory|View|\Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('messages.edit', [
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message->update($validated);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect('/');
    }

    public function upVote($id)
    {
        Message::find($id)->increment('vote_count');
        return redirect('/');

    }

    public function downVote($id)
    {
        Message::find($id)->decrement('vote_count');
        //dd($message);
        return redirect('/');
    }
}


