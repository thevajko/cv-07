<?php

/** @var \App\Models\Post[] $posts */
/** @var Framework\Support\LinkGenerator $link */

use App\Configuration;

?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <a href="<?= $link->url('post.add') ?>" class="btn btn-success">Pridať príspevok</a>
        </div>
    </div>
    <div class="row g-4 justify-content-center">
        <?php foreach ($posts as $post) { ?>
            <div class="col-auto mw-100">
                <div class="card post h-100">
                    <img src="<?= e($link->asset(Configuration::UPLOAD_URL . $post->getPicture())) ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <p class="card-text"><?= e($post->getText()) ?></p>
                    </div>
                    <div class="card-footer d-flex gap-2 justify-content-end">
                        <a href="<?= $link->url('post.edit', ['id' => $post->getId()]) ?>" class="btn btn-primary">Upraviť</a>
                        <form method="post" action="<?= $link->url('post.delete') ?>">
                            <input type="hidden" name="id" value="<?= $post->getId() ?>">
                            <button type="submit" class="btn btn-danger">Zmazať</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
