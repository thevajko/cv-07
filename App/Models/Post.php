<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{

    protected ?int $id = null;
    protected ?string $text;
    protected ?string $picture;
    protected ?string $author;

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

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getLikeCount()
    {
        // get all likes of this post
        $likesCount = Like::getAll("post_id = ?", [$this->id]);
        // count them
        return count($likesCount);
    }

    public function likeToggle($userName)
    {
        // only for stored
        if (empty($this->id)) {
            throw new \Exception("Post must be stored or loaded to toggle like.");
        }
        // get all likes from this user for this post (there is always only one or none)
        $likes = Like::getAll("post_id = ? AND liker like ?", [$this->id, $userName]);
        if (count($likes) > 0) {
            // remove likes if there are any
            foreach ($likes as $like) {
                $like->delete();
            }
        } else {
            // if there are not, create one
            $like = new Like();
            $like->setPostId($this->id);
            $like->setLiker($userName);
            $like->save();
        }
    }

}