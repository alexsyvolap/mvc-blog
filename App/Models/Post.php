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
    public function getAllPosts()
    {
        $query = 'SELECT * FROM '.self::TABLE_NAME. ' ORDER BY timestamp DESC';
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

    public function createPost(array $params)
    {
        $query = 'INSERT INTO '.self::TABLE_NAME.' (title, content, status, tags, timestamp) VALUE ("'.$params['title'].'", 
            "'.$params['content'].'", "'.$params['status'].'", "'.$params['tags'].'", "'.Carbon::now().'");';
        $database = $this->getDB();
        $database->query($query);
        $postId = $database->lastInsertId();
        $post = self::findOrFail($postId);
        return $post;
    }

}