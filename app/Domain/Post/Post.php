<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 21:15
 */

namespace App\Domain\Post;


class Post
{
    /** @var string */
    private $text;
    /** @var int */
    private $user_id;
    /** @var int */
    private $postId;

    /**
     * PostRequest constructor.
     * @param int $postId
     * @param string $text
     * @param int $user_id
     */
    public function __construct(string $text, int $user_id)
    {
        $this->text = $text;
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }
}