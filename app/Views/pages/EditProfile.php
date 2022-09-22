<div class="container mt-5 py-5 align-middle">
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

    <div class="row justify-content-md-center">
        <div class="col-5">
            <h2>Register User</h2>
            <?php if (isset($validation)) : ?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>/UserController/update" method="post">
                <input type="number" value="<?= $user['id'] ?>" name="id" id="id" hidden readonly>
                <div class="form-group mb-3">
                    <input type="text" name="first_name" placeholder="First Name" value="<?= $user['first_name'] ?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="last_name" placeholder="Last Name" value="<?= $user['last_name'] ?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" placeholder="Email" value="<?= $user['email'] ?>" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>