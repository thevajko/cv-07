<?php

namespace App\Models;

use Framework\Core\Model;

class Post extends Model
{

    protected ?int $id = null;
    protected ?string $text;
    protected ?string $picture;
    protected ?string $author ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getLikeCount(): int
    {
        return count($this->getAllRelated(Like::class, "post_id"));
    }
}