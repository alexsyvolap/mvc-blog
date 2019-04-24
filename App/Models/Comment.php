<?php


namespace App\Models;

use App\Service\createCommentDTO;
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

    /**
     * @param $postId
     * @return array|\Exception
     * Вызвращает все коментарии к посту
     */
    public static function getAllPostComments($postId)
    {
        $sql = 'SELECT * FROM '.self::TABLE_NAME.' WHERE post_id = ? ORDER BY timestamp ASC';
        $comments = self::getQuery($sql, [$postId]);
        return $comments;
    }

    /**
     * @param $id
     * @return mixed
     * Ищет комментарий по ИД
     */
    public static function findCommentById($id)
    {
        $sql = 'SELECT * FROM '.self::TABLE_NAME.' WHERE id = ?';
        $comment = Model::getOneQuery($sql, [$id]);
        return $comment;
    }

    /**
     * @param createCommentDTO $params
     * @return mixed
     * Создает комментарий
     */
    public static function createComment(createCommentDTO $createCommentDTO)
    {
        if(is_null($createCommentDTO->getEmail()) || is_null($createCommentDTO->getComment())) {
            return null;
        }

        $sql = 'INSERT INTO '.self::TABLE_NAME.' (email, content, post_id, timestamp) VALUES (?, ?, ?, ?)';
        $createCommentId = self::setQuery($sql, [$createCommentDTO->getEmail(), $createCommentDTO->getComment(),
            $createCommentDTO->getPostId(), $createCommentDTO->getNowDate()]);
        return $createCommentId;
    }

}