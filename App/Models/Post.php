<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Class Post
 * Represents a post consisting of a text and a picture.
 *
 * The model is mapped to the `posts` table. Its properties have the same names as the table columns.
 *
 * @package App\Models
 */
class Post extends Model
{
    /**
     * Properties that can be set from a request by setFromRequest(). The primary key is never set from a request.
     * The picture is an uploaded file, so its name is set in the controller.
     *
     * @var string[]|null
     */
    protected static ?array $fillable = ['text'];

    /**
     * Primary key of the post, null until the post is saved to the database.
     */
    protected ?int $id = null;

    /**
     * Text of the post. The column allows NULL.
     */
    protected ?string $text = null;

    /**
     * File name of the picture stored in the upload directory. The column is NOT NULL, so an empty string is the default.
     */
    protected string $picture = '';

    /**
     * Returns the primary key of the post.
     *
     * @return int|null The post ID, or null if the post has not been saved yet.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns the text of the post.
     *
     * @return string|null The post text, or null if it is not set.
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Sets the text of the post.
     *
     * @param string|null $text The new post text.
     * @return void
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    /**
     * Returns the file name of the picture.
     *
     * @return string The picture file name.
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * Sets the file name of the picture.
     *
     * @param string $picture The new picture file name.
     * @return void
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }
}
