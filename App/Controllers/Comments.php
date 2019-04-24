<?php


namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Service\createCommentDTO;
use Carbon\Carbon;
use Core\Controller;

class Comments extends Controller
{

    /**
     * @return mixed
     * @throws \Exception
     * Создает комментарий
     */
    public function commentSendAction()
    {
        $postId = $this->route_params['id'];
        if(empty($post = Post::findPostById($postId))) {
            throw new \Exception("Пост $postId не найден");
        }

        $postParams = self::createCommentDto($postId, $this->route_params['POST']);
        $commentId = Comment::createComment($postParams);
        $comment = Comment::findCommentById($commentId);
        return print_r(json_encode($comment));
    }

    /**
     * @return mixed
     * Возвращает количество коментариев
     */
    public function getCommentCountAction()
    {
        return print_r(json_encode(Post::getPostCommentCount($this->route_params['id'])));
    }

    /**
     * @param $postId
     * @param $params
     * @return createCommentDTO
     * createCommentDto
     */
    private function createCommentDto($postId, $params)
    {
        return new createCommentDTO($params['mail'], $params['comment'], $postId);
    }

}