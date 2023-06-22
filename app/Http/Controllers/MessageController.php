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
        return view('messages.index', ['messages' => $messages]);
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

        Message::create([
            'message'    => $request->message,
        ]);

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

    public function upVote(Message $message, Request $request, $id)
    {
        $message->increment('vote_count', 1);
        return redirect()->back();
    }

    public function downVote(Message $message, Request $request, $id)
    {
        $message->decrement('vote_count', 1);
        return redirect()->back();
    }
}


