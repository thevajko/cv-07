<?php

namespace App\Controllers;

use App\Configuration;
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

        $errors = $this->formErrors($request);
        if (count($errors) > 0) {
            return $this->html(
                ['post' => $post, 'errors' => $errors],
                $post->getId() === null ? 'add' : 'edit'
            );
        }

        // Store the uploaded file under a unique name, so files with the same name do not overwrite each other
        $file = $request->file('picture');
        $fileName = time() . '-' . $file->getName();
        if (!$file->store(Configuration::UPLOAD_DIR . $fileName)) {
            throw new HttpException(500, 'Obrázok sa nepodarilo uložiť.');
        }

        $oldFileName = $post->getPicture();
        $post->setPicture($fileName);
        $post->save();
        $this->deletePicture($oldFileName);

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
     * @return string[] List of error messages, empty if the form is valid.
     */
    private function formErrors(Request $request): array
    {
        $errors = [];
        if ($request->file('picture')->getName() == "") {
            $errors[] = "Pole Súbor obrázka musí byť vyplnené!";
        }
        if ($request->value('text') == "") {
            $errors[] = "Pole Text príspevku musí byť vyplnené!";
        }
        if ($request->file('picture')->getName() != "" &&
            !in_array($request->file('picture')->getType(), ['image/jpeg', 'image/png'])) {
            $errors[] = "Obrázok musí byť typu JPG alebo PNG!";
        }
        if ($request->value('text') != "" && strlen($request->value('text')) < 5) {
            $errors[] = "Počet znakov v text príspevku musí byť viac ako 5!";
        }
        return $errors;
    }
}
