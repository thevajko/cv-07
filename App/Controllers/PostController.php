<?php

namespace App\Controllers;

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
     * @return Response The redirect response to the list of posts.
     * @throws HttpException If the edited post does not exist.
     */
    public function save(Request $request): Response
    {
        $post = (int)$request->value('id') > 0 ? $this->findPost($request) : new Post();
        $post->setFromRequest($request);
        $post->save();

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
        $this->findPost($request)->delete();

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
}
