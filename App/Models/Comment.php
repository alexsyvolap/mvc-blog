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



}