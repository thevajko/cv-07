<?php

/** @var \App\Models\Post $post */
/** @var string[]|null $errors */
/** @var Framework\Support\LinkGenerator $link */
?>

<?php foreach ($errors ?? [] as $error) { ?>
    <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
<?php } ?>

<form method="post" action="<?= $link->url('post.save') ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $post->getId() ?>">
    <div class="mb-3">
        <label for="picture" class="form-label">Súbor obrázka</label>
        <input type="file" class="form-control" name="picture" id="picture">
        <?php if ($post->getPicture() != "") { ?>
            <div class="form-text">Aktuálny súbor: <?= e(substr($post->getPicture(), strpos($post->getPicture(), '-') + 1)) ?></div>
        <?php } ?>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Text príspevku</label>
        <textarea class="form-control" name="text" id="text"><?= e($post->getText()) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Uložiť</button>
</form>
