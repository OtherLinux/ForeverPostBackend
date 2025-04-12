<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class UserPosts extends Controller
{
    //
    public function RequestMessageRange(Request $request, string $begin, string $end)
    {

        $begin = intval($begin);
        $end = intval($end);

        if ($begin > $end) {
            $tmp_var = $end;
            $end = $begin;
            $begin = $tmp_var;
        }

        $begin = ($begin < 1) ? 1 : $begin;
        $end = ($end < 1) ? 1 : $end;

        if ($end - $begin > 20) {
            return false;
        }

        $postData = Post::whereBetween('id', [$begin, $end])->get();

        if (!$postData->isEmpty()) {
            return response()->json($postData);
        }
    }

    public function GetNewestPosts(Request $request)
    {

        $postData = Post::whereBetween('id', [Post::all()->max("id")-10, Post::all()->max("id")])->get();
        $postData[0]->highest_id = Post::all()->max("id");

        if (!$postData->isEmpty()) {
            return response()->json($postData);
        }
    }

    public function CreateMessage(Request $request)
    {
        $dspName = $request->input("displayName");
        $msgCnt = $request->input("message");

        if (!($dspName == "" || $msgCnt == "") && !(strlen($dspName) > 32 || strlen($msgCnt) > 256) && (gettype($dspName) == "string" && gettype($msgCnt) == "string")) {

            $post = new Post;
            $post->display_name = strip_tags($dspName);
            $post->message = strip_tags($msgCnt);
            $post->nsfw = false;
            $post->hidden = false;
            $post->save();
        }
    }

    public function SearchForMessage(Request $request, string $messageId)
    {
        $postData = Post::where("id", $messageId)->first();
        if ($postData) {
            return response()->json($postData);
        }
    }

    public function GetNewestMessageId(Request $request)
    {
        return response()->json([
            'newestMessageId' => Post::all()->max("id"),
        ]);
    }


}
