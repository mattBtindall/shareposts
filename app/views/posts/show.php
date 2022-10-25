<?php require APP_ROOT . '/views/inc/header.php'; ?>
    <a href="<?= URL_ROOT; ?>/posts" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <h1><?= $data['post']->title; ?></h1>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?= $data['user']->name; ?> on <?= $data['post']->created_at; ?>
    </div>
    <p><?= $data['post']->body; ?></p>

    <?php if ($data['post']->user_id === $_SESSION['user_id']) : ?>
        <hr>
        <div class="d-flex justify-content-between">
            <a href="<?= URL_ROOT; ?>/posts/edit/<?= $data['post']->id; ?>" class="btn btn-dark">Edit</a>
            <form class="" action="<?= URL_ROOT; ?>/posts/delete/<?= $data['post']->id; ?>" method="post">
                <input type="submit" value="delete" class="btn btn-danger">
            </form>
        </div>
    <?php endif; ?>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>