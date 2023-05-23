<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Controllers\Controller;
use App\Models\LikeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class LikeAndCommentApiController extends Controller
{
    //get all like and comment
    public function getLikeComment()
    {
        $likeCommentData = LikeComment::join('users', 'like_comments.user_id', 'users.id')
            ->select('like_comments.*', 'users.id as user_id', 'users.name as user_name', 'users.profile_photo_path as user_profile')
            ->get();
        return response()->json([
            'likeCommentData' => $likeCommentData,
        ], 200);
    }
    //like and comment function
    public function likeComment($userId, $postId, Request $request)
    {
        $dbData = LikeComment::where('user_id', $userId)
            ->where('post_id', $postId)
            ->get();

        if (!$dbData->isEmpty()) {
            $status = $this->updateLikeComment($dbData, $userId, $postId, $request);
            return response()->json($status);
        }

        $status = $this->createLikeComment($userId, $postId, $request);
        return response()->json($status);
    }

    //Create Like or Comment
    private function createLikeComment($userId, $postId, Request $request)
    {
        if ($request->toArray() != Null) {
            LikeComment::create(['user_id' => $userId, 'post_id' => $postId, 'comment' => $request->comment]);
            return ['status' => 'This created comment only!'];
        }

        LikeComment::create(['user_id' => $userId, 'post_id' => $postId, 'like' => 1]);
        return ['status' => 'This created like only!'];
    }

    //Update Like or Comment
    private function updateLikeComment($dbData, $userId, $postId, Request $request)
    {

        if ($request->toArray() != Null) {
            LikeComment::where('user_id', $userId)
                ->where('post_id', $postId)
                ->update(['comment' => $request->comment]);

            return ['status' => 'This updated comment only!'];
        }

        if ($dbData[0]->like == 0) {
            LikeComment::where('user_id', $userId)
                ->where('post_id', $postId)
                ->update(['like' => 1]);

            return ['status' => 'Liked!'];
        }

        LikeComment::where('user_id', $userId)
            ->where('post_id', $postId)
            ->update(['like' => 0]);

        return ['status' => 'Unliked!'];
    }
}
