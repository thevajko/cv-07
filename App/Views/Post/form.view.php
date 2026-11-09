<?php

/** @var \App\Models\Post $post */
/** @var Framework\Support\LinkGenerator $link */
?>

<form method="post" action="<?= $link->url('post.save') ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $post->getId() ?>">
    <div class="mb-3">
        <label for="picture" class="form-label">URL obrázka</label>
        <input type="file" class="form-control" name="picture" id="picture" value="<?= e($post->getPicture()) ?>">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Text príspevku</label>
        <textarea class="form-control" name="text" id="text"><?= e($post->getText()) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Uložiť</button>
</form>
