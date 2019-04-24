<?php


namespace App\Models;

use App\Lang;
use App\Service\createPostDTO;
use Carbon\Carbon;
use Core\Model;
use PDO;

/**
 * Class Post
 * @package App\Models
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $tags
 * @property Carbon $timestamp
 */
class Post extends Model
{

    use PostGetters;

    const TABLE_NAME = 'posts';

    const STATUS_NEW = 0;
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 2;

    /**
     * @return array
     * Забираем с базы посты
     */
    public static function getAllPosts()
    {
        $sql = 'SELECT * FROM '.self::TABLE_NAME.' ORDER BY timestamp DESC';
        $posts = self::getQuery($sql);
        return $posts;
    }

    /**
     * @param $id
     * @return mixed
     * Забираем с базы посчитанное количество комментов к посту
     */
    public static function getPostCommentCount($id)
    {
        $sql = 'SELECT COUNT(id) AS count FROM comments WHERE post_id = ?';
        $count = Model::getOneQuery($sql, [$id]);
        return $count;
    }

    /**
     * @param $id
     * @return mixed
     * Ищем пост по ид
     */
    public static function findPostById($id)
    {
        $sql = 'SELECT * FROM '.self::TABLE_NAME.' WHERE id = ?';
        $post = Model::getOneQuery($sql, [$id]);
        return $post;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Exception
     * Создаем пост и возвращаем его ид
     */
    public static function createPost(createPostDTO $createPostDTO)
    {
        if(is_null($createPostDTO->getTitle()) || is_null($createPostDTO->getStatus())) {
            return null;
        }

        $sql = 'INSERT INTO '.self::TABLE_NAME.' (title, content, status, tags, timestamp) VALUES (?, ?, ?, ?, ?)';
        $createdPostId = self::setQuery($sql, [$createPostDTO->getTitle(), $createPostDTO->getContent(), $createPostDTO->getStatus(),
            $createPostDTO->getTags(), $createPostDTO->getNowDate()]);
        return $createdPostId;
    }

    /**
     * @param $id
     * @return array|\Exception
     * Удаляем пост
     */
    public static function deletePost($id)
    {
        $sql = 'DELETE FROM '.self::TABLE_NAME.' WHERE id = ?';
        return Model::getQuery($sql, [$id]);
    }

    /**
     * @param $id
     * @param array $params
     * @return bool|mixed
     * Редактируем пост
     */
    public static function editPost($post, createPostDTO $createPostDTO)
    {
        $postId = $post['id'];
        $sql = 'UPDATE '.self::TABLE_NAME.' SET title=?, status=?, content=?, tags=? WHERE id=?';
        self::getOneQuery($sql, [$createPostDTO->getTitle(), $createPostDTO->getStatus(), $createPostDTO->getContent(),
            $createPostDTO->getTags(), $postId]);
        return $post;
    }

}