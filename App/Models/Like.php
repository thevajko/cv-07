<?php

namespace App\Models;

use Framework\Core\Model;

class Like extends Model
{
    protected ?int $id = null;
    protected int $postId;
    protected string $liker;

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getLiker(): string
    {
        return $this->liker;
    }

    public function setLiker(string $liker): void
    {
        $this->liker = $liker;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


}