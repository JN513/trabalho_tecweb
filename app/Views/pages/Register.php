<div class="container mt-5 py-5 align-middle">
    <div class="row justify-content-md-center">
        <div class="col-5">
            <h2>Register User</h2>
            <?php if (isset($validation)) : ?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>/SignupController/store" method="post">
                <div class="form-group mb-3">
                    <input type="text" name="first_name" placeholder="First Name" value="<?= set_value('first_name') ?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="last_name" placeholder="Last Name" value="<?= set_value('last_name') ?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control">
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