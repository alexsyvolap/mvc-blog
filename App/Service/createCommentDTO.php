<?php


namespace App\Service;


use Carbon\Carbon;

class createCommentDTO
{

    private $email;
    private $comment;
    private $postId;
    private $nowDate;

    /**
     * createCommentDTO constructor.
     * @param $email
     * @param $comment
     * @param $postId
     * @param $nowDate
     */
    public function __construct($email, $comment, $postId)
    {
        $this->email = $email;
        $this->comment = $comment;
        $this->postId = $postId;
        $this->nowDate = Carbon::now();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @return Carbon|\Carbon\CarbonInterface
     */
    public function getNowDate()
    {
        return $this->nowDate;
    }


}