<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\HTTPException;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Models\Post;

class LikeController extends AControllerBase
{
    public function authorize($action): bool
    {
        return $this->app->getAuth()->isLogged();
    }
    public function index(): Response
    {
        throw new HTTPException(501);
    }

    public function toggle(){
        // get id of post to toggle like
        $id = $this->request()->getValue("id");
        // get post from db
        $postToLike = Post::getOne($id);
        // toggle like
        $postToLike->likeToggle($this->app->getAuth()->getLoggedUserName());
        // redirect to home
        return new RedirectResponse($this->url('home.index'));
    }

}