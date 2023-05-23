<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actionLogData = ActionLog::join('users', 'action_logs.user_id', 'users.id')
            ->join('posts', 'action_logs.post_id', 'posts.id')
            ->select('action_logs.*', 'users.name as user_name', 'posts.title as post_title')
            ->orderBy('action_logs.created_at', 'asc')
            ->paginate(5);

        return view('ActionLog.index', compact('actionLogData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $actionLogData = ActionLog::where('action_logs.id', $id)
            ->join('users', 'action_logs.user_id', 'users.id')
            ->join('posts', 'action_logs.post_id', 'posts.id')
            ->select('action_logs.*', 'users.name as user_name', 'posts.title as post_title')
            ->first();


        return view('ActionLog.show', compact('actionLogData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ActionLog::where('id', $id)->delete();
        return back()->with(['status' => 'You Deleted Successfully!']);
    }
}
