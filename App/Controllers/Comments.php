<?php


namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Core\Controller;

class Comments extends Controller
{

    public function commentSendAction()
    {
        if($this->request_method === 'POST') {
            $postId = $this->route_params['id'];
            $postParams = $this->route_params['POST'];
            $commentModel = new Comment();
            $comment = $commentModel->createComment($postId, $postParams);
            return print_r(json_encode($comment));
        }
    }

    public function getCommentCountAction()
    {
        return print_r(json_encode(Post::getPostCommentCount($this->route_params['id'])));
    }

}