<?php


namespace App\Controllers;

use App\Lang;
use App\Models\Comment;
use App\Models\Post;
use Core\Controller;
use Core\Redirect;
use Core\View;

class News extends Controller
{

    /**
     * @throws \Exception
     * Выводим все новости на страницу
     */
    public function indexAction()
    {
        $title = Lang::getRu()['posts']['pages']['news'];
        $postModel = new Post();
        $posts = $postModel->getAllPosts('DESC');
        View::render('News/index.php', compact('posts', 'title'));
    }

    /**
     * @throws \Exception
     * Просматриваем пост
     */
    public function postViewAction()
    {
        $id = $this->route_params['id'];
        if(!is_null($id)) {
            $title = Lang::getRu()['posts']['pages']['newsId'] . ' №' . $id;
            $postModel = new Post();
            $post = $postModel->findOrFail($id);
            $comments = Comment::getAllPostComments($id, 'ASC');
            View::render('News/postView.php', compact('post', 'title', 'comments'));
        } else {
            throw new \Exception("$id not found");
        }
    }

    /**
     * @throws \Exception
     * Создаем пост
     */
    public function createPostAction()
    {
        if($this->request_method === 'GET') {
            $title = Lang::getRu()['posts']['pages']['createPost'];
            View::render('News/postCreate.php', compact('title'));
        } elseif($this->request_method === 'POST') {
            $postParams = $this->route_params['POST'];
            $postModel = new Post();
            $post = $postModel->createPost($postParams);
            return print_r(json_encode($post));
        }
    }

    /**
     * @return mixed
     * Удаляем пост
     */
    public function postDeleteAction()
    {
        $postId = $this->route_params['id'];
        if($this->request_method === 'POST') {
            $postModel = new Post();
            if($postModel->deletePost($postId)) {
                return print_r(json_encode(array('value' => 'true')));
            } else {
                return print_r(json_encode(array('value' => 'false')));
            }
        }
    }

    /**
     * @return mixed
     * Редактируем пост
     */
    public function postEditAction()
    {
        $postId = $this->route_params['id'];
        if($this->request_method === 'POST') {
            $postParams = $this->route_params['POST'];
            $postModel = new Post();
            if($post = $postModel->editPost($postId, $postParams)) {
                return print_r(json_encode($post));
            } else {
                return print_r(json_encode(array('value' => 'false')));
            }
        }
    }

}