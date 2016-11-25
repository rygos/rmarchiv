<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;


class CommentController extends Controller
{
    public function add(Request $request){
        $comment = new Comment;

        $comment->user_id = \Auth::id();
        $comment->content_id = $request->get('content_id');
        $comment->content_type = $request->get('content_type');
        $comment->comment_md = $request->get('comment');
        $comment->comment_html = Markdown::convertToHtml($request->get('comment'));

        $rate = $request->get('rating');

        if($rate == 'up'){
            $comment->vote_up = 1;
            $comment->vote_down = 0;
        }elseif($rate == 'down'){
            $comment->vote_up = 0;
            $comment->vote_down = 1;
        }else{
            $comment->vote_up = 0;
            $comment->vote_down = 0;
        }

        $comment->save();


        return redirect()->action('MsgBoxController@comment_add', [$request->get('content_type') ,$request->get('content_id')]);
    }
}