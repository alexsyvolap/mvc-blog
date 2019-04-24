<?php


namespace App\Controllers;

use App\Lang;
use App\Models\Comment;
use App\Models\Post;
use App\Service\createPostDTO;
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
        if(empty($post = Post::findPostById($id))) {
            throw new \Exception("Пост $id не найден");
        }

        $title = Lang::getRu()['posts']['pages']['newsId'] . ' №' . $id;
        $comments = Comment::getAllPostComments($id);
        View::render('News/postView.php', compact('post', 'title', 'comments'));
    }

    /**
     * @throws \Exception
     * Создаем пост
     */
    public function createPostAction()
    {
        $postParams = self::createPostDto($this->route_params['POST']);
        $postModel = new Post();
        $createDPostId = $postModel->createPost($postParams);
        $post = Post::findPostById($createDPostId);
        return print_r(json_encode($post));
    }

    /**
     * @return mixed
     * @throws \Exception
     * Удаляем пост
     */
    public function postDeleteAction()
    {
        $postId = $this->route_params['id'];
        if(empty($post = Post::findPostById($postId))) {
            throw new \Exception("Пост $postId не найден");
        }

        $postModel = new Post();
        return print_r(json_encode($postModel->deletePost($postId)));
    }

    /**
     * @return mixed
     * @throws \Exception
     * Редактируем пост
     */
    public function postEditAction()
    {
        $postId = $this->route_params['id'];
        if(empty($post = Post::findPostById($postId))) {
            throw new \Exception("Пост $postId не найден");
        }

        $postParams = self::createPostDto($this->route_params['POST']);
        $postModel = new Post();
        $postModel->editPost($post, $postParams);
        return print_r(json_encode($post));
    }

    /**
     * @param array $params
     * @return createPostDTO
     * createdto
     */
    public function createPostDto($params)
    {
        return new createPostDTO($params['title'], $params['content'], $params['status'], $params['tags']);
    }

}