<div class="container mt-5 py-5 align-middle">
    <div class="row justify-content-md-center">
        <div class="col-5">
            <h2>Alterar Senha</h2>
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
            <form action="<?php echo base_url(); ?>/user/changepassword" method="post">
                <div class="form-group mb-3">
                    <input type="password" name="oldpassword" placeholder="Old Password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>