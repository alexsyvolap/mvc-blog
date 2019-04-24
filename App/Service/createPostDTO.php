<?php


namespace App\Service;


use Carbon\Carbon;

class createPostDTO
{

    private $title;
    private $content;
    private $status;
    private $tags;
    private $nowDate;

    /**
     * createPostDTO constructor.
     * @param $title
     * @param $content
     * @param $status
     * @param $tags
     */
    public function __construct($title, $content, $status, $tags)
    {
        $this->title = $title;
        $this->content = $content;
        $this->status = $status;
        $this->tags = $tags;
        $this->nowDate = Carbon::now();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return Carbon|\Carbon\CarbonInterface
     */
    public function getNowDate()
    {
        return $this->nowDate;
    }


}