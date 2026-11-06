<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Class Like
 * Represents a like of a post.
 *
 * The model is mapped to the `likes` table. Its properties have the same names as the table columns.
 *
 * @package App\Models
 */
class Like extends Model
{
    /**
     * Primary key of the like, null until the like is saved to the database.
     */
    protected ?int $id = null;

    /**
     * ID of the liked post.
     */
    protected ?int $post_id = null;

    /**
     * Name of the user who liked the post.
     */
    protected string $liker = '';

    /**
     * Returns the primary key of the like.
     *
     * @return int|null The like ID, or null if the like has not been saved yet.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns the ID of the liked post.
     *
     * @return int|null The post ID.
     */
    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    /**
     * Sets the ID of the liked post.
     *
     * @param int $postId The post ID.
     * @return void
     */
    public function setPostId(int $postId): void
    {
        $this->post_id = $postId;
    }

    /**
     * Returns the name of the user who liked the post.
     *
     * @return string The user name.
     */
    public function getLiker(): string
    {
        return $this->liker;
    }

    /**
     * Sets the name of the user who liked the post.
     *
     * @param string $liker The user name.
     * @return void
     */
    public function setLiker(string $liker): void
    {
        $this->liker = $liker;
    }
}
