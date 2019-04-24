<?php


namespace App\Models;

use Carbon\Carbon;
use Core\Model;
use PDO;

/**
 * Class Comment
 * @package App\Models
 * @property integer $id
 * @property integer $post_id
 * @property string $content
 * @property string $email
 * @property Carbon $timestamp
 */
class Comment extends Model
{

    const TABLE_NAME = 'comments';

    protected $fillable = [
        'id', 'post_id', 'content', 'email', 'timestamp'
    ];

    public static function getAllPostComments($postId)
    {
        $sql = 'SELECT * FROM '.self::TABLE_NAME.' WHERE post_id = ? ORDER BY timestamp ASC';
        $comments = self::getQuery($sql, [$postId]);
        return $comments;
    }

    public function findOrFail($id)
    {
        $query = 'SELECT * FROM '.self::TABLE_NAME.' WHERE id='.$id;
        $post = $this->getDB()->query($query);
        if(is_null($post)) {
            throw new \Exception("Коммент с ID: $id , не найден!");
        } else {
            return $post->fetch();
        }
    }

    public function createComment($postId, array $params)
    {
        if(!empty($params['mail']) || !empty($params['comment'])) {
            $query = 'INSERT INTO '.Comment::TABLE_NAME.' (email, content, post_id, timestamp) VALUE ("'.$params['mail'].'", 
                "'.$params['comment'].'", "'.$postId.'", "'.Carbon::now().'");';
            $database = $this->getDB();
            $database->query($query);
            $commentId = $database->lastInsertId();
            $comment = self::findOrFail($commentId);
            return $comment;
        }
    }

}