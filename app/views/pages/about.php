<?php require APP_ROOT . '/views/inc/header.php'; ?>
    <div class="p-5 mb-4 bg-light rounded-3 text-center">
        <div class="container">
            <h1 class="display-3"><?= $data['title']; ?></h1>
            <p class="lead"><?= $data['description']; ?></p>
            <p>Version: <strong><?= APP_VERSION; ?></strong></p>
        </div>
    </div>
<?php require APP_ROOT . '/views/inc/footer.php'; ?>