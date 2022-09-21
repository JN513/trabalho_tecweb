<div class="container align-middle">
    <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-warning">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>

    <?php if (isset($validation)) : ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>

    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h2>Perfil</h2>
            <h3><?= $user['first_name'] ?></h3>
            <h3><?= $user['last_name'] ?></h3>
            <p><?= $user['email'] ?></p>
        </div>
    </div>
</div>
</div>