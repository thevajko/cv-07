<?php

namespace App\Controllers;

use App\Configuration;
use App\Models\Like;
use App\Models\Post;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class PostController
 * Handles CRUD operations for posts.
 *
 * @package App\Controllers
 */
class PostController extends BaseController
{
    /**
     * Displays all posts.
     *
     * @return Response The response object containing the rendered list of posts.
     */
    public function index(Request $request): Response
    {
        return $this->html(['posts' => Post::getAll()]);
    }

    /**
     * Displays the form for adding a new post.
     *
     * @return Response The response object containing the rendered form.
     */
    public function add(Request $request): Response
    {
        return $this->html(['post' => new Post()]);
    }

    /**
     * Displays the form for editing an existing post.
     *
     * @return Response The response object containing the rendered form filled with the post data.
     * @throws HttpException If the post does not exist.
     */
    public function edit(Request $request): Response
    {
        return $this->html(['post' => $this->findPost($request)]);
    }

    /**
     * Saves a new or an edited post and redirects to the list of posts.
     *
     * If the form contains errors, the form is displayed again together with the errors.
     *
     * @return Response The redirect response to the list of posts or the form with errors.
     * @throws HttpException If the edited post does not exist.
     */
    public function save(Request $request): Response
    {
        $post = (int)$request->value('id') > 0 ? $this->findPost($request) : new Post();
        $post->setFromRequest($request);

        $errors = $this->formErrors($request, $post->getId() === null);
        if (count($errors) > 0) {
            return $this->html(
                ['post' => $post, 'errors' => $errors],
                $post->getId() === null ? 'add' : 'edit'
            );
        }

        // The picture is optional when editing, without a new file the original picture is kept
        $file = $request->file('picture');
        if ($file != null && $file->getName() != "") {
            // Store the uploaded file under a unique name, so files with the same name do not overwrite each other
            $fileName = time() . '-' . $file->getName();
            if (!$file->store(Configuration::UPLOAD_DIR . $fileName)) {
                throw new HttpException(500, 'Obrázok sa nepodarilo uložiť.');
            }
            $oldFileName = $post->getPicture();
            $post->setPicture($fileName);
            $post->save();
            $this->deletePicture($oldFileName);
        } else {
            $post->save();
        }

        return $this->redirect($this->url('post.index'));
    }

    /**
     * Deletes a post and redirects to the list of posts.
     *
     * @return Response The redirect response to the list of posts.
     * @throws HttpException If the post does not exist or the request is not POST.
     */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }
        $post = $this->findPost($request);
        $post->delete();
        $this->deletePicture($post->getPicture());

        return $this->redirect($this->url('post.index'));
    }

    /**
     * Saves a like of a post and redirects to the list of posts. The like is saved every time the user clicks.
     *
     * @return Response The redirect response to the list of posts.
     * @throws HttpException If the post does not exist or the request is not POST.
     */
    public function like(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }
        $post = $this->findPost($request);

        $like = new Like();
        $like->setPostId($post->getId());
        $like->setLiker('Anonym');
        $like->save();

        return $this->redirect($this->url('post.index'));
    }

    /**
     * Loads the post identified by the `id` request parameter.
     *
     * @throws HttpException If the post does not exist.
     */
    private function findPost(Request $request): Post
    {
        $post = Post::getOne((int)$request->value('id'));
        if ($post === null) {
            throw new HttpException(404, 'Príspevok neexistuje.');
        }
        return $post;
    }

    /**
     * Deletes the picture file from the upload directory, if it exists.
     *
     * @param string $fileName File name of the picture.
     */
    private function deletePicture(string $fileName): void
    {
        $path = Configuration::UPLOAD_DIR . $fileName;
        if ($fileName != "" && is_file($path)) {
            unlink($path);
        }
    }

    /**
     * Validates the post form.
     *
     * @param Request $request
     * @param bool $isNew True for a new post, the picture is required only for a new post.
     * @return string[] List of error messages, empty if the form is valid.
     */
    private function formErrors(Request $request, bool $isNew): array
    {
        $errors = [];
        $picture = $request->file('picture');
        if ($picture == null || $picture->getName() == "") {
            if ($isNew) {
                $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
            }
        } elseif ($picture->getError() == UPLOAD_ERR_INI_SIZE) {
            $errors[] = "Obrázok je príliš veľký, maximálna veľkosť je " . ini_get('upload_max_filesize') . "B!";
        } elseif (!$picture->isOk()) {
            $errors[] = "Obrázok sa nepodarilo nahrať!";
        } elseif (!in_array($picture->getType(), ['image/jpeg', 'image/png'])) {
            $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
        }
        if ($request->value('text') == "") {
            $errors[] = "Pole Text príspevku musí byť vyplnené!";
        }
        if ($request->value('text') != "" && mb_strlen($request->value('text')) < 5) {
            $errors[] = "Text príspevku musí mať aspoň 5 znakov!";
        }
        return $errors;
    }
}
