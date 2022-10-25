<?php require APP_ROOT . '/views/inc/header.php'; ?>
    <a href="<?= URL_ROOT; ?>/posts" class="btn btn-light"><i class="bi bi-arrow-left me-1"></i>Back</a>
    <div class="card card-body bg-light mt-2">
        <h2>Edit Post</h2>
        <p>Create a post wth this form</p>
        <form action="<?= URL_ROOT; ?>/posts/edit/<?= $data['id']; ?>" method="post">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?= $data['title']; ?>">
                <span class="invalid-feedback"><?= $data['title_error']; ?></span>
            </div>

            <div class="form-group mt-2">
                <label for="body">Body: <sup>*</sup></label>
                <textarea  name="body" class="form-control form-control-lg <?= (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>"><?= $data['body']; ?></textarea>
                <span class="invalid-feedback"><?= $data['body_error']; ?></span>
            </div>
            <input type="submit" class="btn btn-success mt-2" value="submit">
        </form>
    </div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>