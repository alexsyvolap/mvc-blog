<?php


namespace App\Models;

use App\Lang;
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

    protected $fillable = [
        'id', 'title', 'content', 'status', 'tags', 'timestamp'
    ];

    /**
     * @return array
     * Забираем с базы посты
     */
    public function getAllPosts($sort)
    {
        $query = 'SELECT * FROM '.self::TABLE_NAME. ' ORDER BY timestamp '.$sort;
        $posts = $this->getDB()->query($query);
        return $posts->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     * Забираем с базы посчитанное количество комментов к посту
     */
    public static function getPostCommentCount($id)
    {
        $query = 'SELECT COUNT(id) FROM comments WHERE post_id='.$id;
        $count = self::getDB()->query($query);
        return $count->fetchColumn(0);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     * Найти пост по ИД или вылететь в ошибку
     */
    public function findOrFail($id)
    {
        $query = 'SELECT * FROM '.self::TABLE_NAME.' WHERE id='.$id;
        $post = $this->getDB()->query($query);
        if(is_null($post)) {
            throw new \Exception("Пост с ID: $id , не найден!");
        } else {
            return $post->fetch();
        }
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Exception
     * Создаем пост
     */
    public function createPost(array $params)
    {
        if(!empty($params['title']) || !empty($params['status'])) {
            $query = 'INSERT INTO '.self::TABLE_NAME.' (title, content, status, tags, timestamp) VALUE ("'.$params['title'].'", 
            "'.$params['content'].'", "'.$params['status'].'", "'.$params['tags'].'", "'.Carbon::now().'");';
            $database = $this->getDB();
            $database->query($query);
            $postId = $database->lastInsertId();
            $post = self::findOrFail($postId);
            return $post;
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @return bool
     * Удаляем пост
     */
    public function deletePost($id)
    {
        try {
            $query = 'DELETE FROM '.self::TABLE_NAME.' WHERE id='.$id;
            $this->getDB()->query($query);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $id
     * @param array $params
     * @return bool|mixed
     * Редактируем пост
     */
    public function editPost($id, array $params)
    {
        try {
            $query = 'UPDATE '.self::TABLE_NAME.' SET title="'.$params['titleModal'].'", status="'.$params['statusModal'].'", 
                content="'.$params['contentModal'].'", tags="'.$params['tagsModal'].'" WHERE id='.$id.';';
            $this->getDB()->query($query);
            $post = self::findOrFail($id);
            return $post;
        } catch (\Exception $exception) {
            return false;
        }
    }

}