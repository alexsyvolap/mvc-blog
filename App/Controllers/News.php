<?php


namespace App\Controllers;

use App\Lang;
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
        $posts = $postModel->getAllPosts();
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
            View::render('News/postView.php', compact('post', 'title'));
        } else {
            throw new \Exception("$id not found");
        }
    }

    /**
     * @throws \Exception
     * Создаем пост
     */
    public function createPost()
    {
        if($this->request_method === 'GET') {
            $title = Lang::getRu()['posts']['pages']['createPost'];
            View::render('News/postCreate.php', compact('title'));
        } elseif($this->request_method === 'POST') {
            $postParams = $this->route_params['POST'];
            $postModel = new Post();
            $post = $postModel->createPost($postParams);
            Redirect::to('/news');
        }
    }

}