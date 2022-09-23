<div class="container">
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


    <div class="table-responsive">
        <div class="container py-3">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Criado em</th>
                        <th>Atualizado em</th>
                        <th>É staff?</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><a href="/profile/<?= $user['id'] ?>" style="text-decoration:none;"><?= $user['first_name'] ?></a></td>
                            <td><?= $user['last_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['created_at'] ?></td>
                            <td><?= $user['updated_at'] ?></td>
                            <td><?php if ($user['is_staff']) echo "Sim";
                                else echo "Não"; ?></td>
                            <td><a href="<?= base_url() ?>/user/edit/<?= $user['id'] ?>" class="btn btn-warning">Editar</a></td>
                            <td><a href="<?= base_url() ?>/user/delete/<?= $user['id'] ?>" class="btn btn-danger">Deletar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>