<?php

/** @var Array $data */
/** @var \App\Models\Post $post */
/** @var App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <?php foreach ($data['posts'] as $post): ?>
            <div class="col-3 d-flex gap-4 flex-column">
                <div class="border post d-flex flex-column">
                    <div>
                        <img src="<?= \App\Helpers\FileStorage::UPLOAD_DIR . '/' . $post->getPicture() ?>" class="img-fluid">
                    </div>
                    <div class="m-2">
                        <?= $post->getText() ?>
                    </div>
                    <div class="m-2">
                        Autor: <strong><?= $post->getAuthor() ?></strong>
                    </div>
                    <div class="m-2 d-flex gap-2 justify-content-end">
                        <?php if ($auth->isLogged() && ($auth->getLoggedUserName() == $post->getAuthor())): ?>
                            <a href="<?= $link->url('like.toggle', ['id' => $post->getId()]) ?>" class="btn btn-primary btn-sm"><?= $post->getLikeCount() ?> <i class="bi bi-hand-thumbs-up"></i></a>
                            <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" class="btn btn-sm btn-primary">Upraviť</a>
                            <a href="<?= $link->url('post.delete', ['id' => $post->getId()]) ?>" class="btn btn-sm btn-danger">Zmazať</a>
                        <?php else: ?>
                            <button class="btn btn-primary btn-sm" disabled><?= $post->getLikeCount() ?> <i class="bi bi-hand-thumbs-up"></i></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>