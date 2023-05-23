<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use Illuminate\Http\Request;

class ActionLogApiController extends Controller
{
    //creating the action log
    public function create($userId, $postId, Request $request)
    {
        $dbData = ActionLog::where('user_id', $userId)
            ->where('post_id', $postId)
            ->orderBy('created_at', 'desc')
            ->get();

        //if there is a comment
        if (!$request->toArray() == Null) {
            if (!$dbData->isEmpty()) {
                ActionLog::create(['user_id' => $userId, 'post_id' => $postId, 'like' => $dbData[0]->like, 'comment' => $request->comment]);
                return response()->json(200);
            }

            ActionLog::create(['user_id' => $userId, 'post_id' => $postId, 'comment' => $request->comment]);
            return response()->json(200);
        }

        //if there is not a comment
        if (!$dbData->isEmpty()) {
            ActionLog::create(['user_id' => $userId, 'post_id' => $postId, 'like' => !$dbData[0]->like]);
            return response()->json(200);
        }

        ActionLog::create(['user_id' => $userId, 'post_id' => $postId, 'like' => 1]);
        return response()->json(200);
    }
}
