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
        <div class="card-footer">
            <div class="d-flex flex-row-reverse">
                <?php if ($user['id'] == session()->get('id') or session()->get('is_staff')) : ?>
                    <div class="d-flex flex-row-reverse py-3">
                        <a href="<?= base_url() ?>/user/edit/<?= $user['id'] ?>" class="btn btn-primary mx-1">Editar</a>
                        <a href="<?= base_url() ?>/user/delete/" class="btn btn-danger mx-1">Deletar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <h3 class="py-3">Publicações:</h3>

    <div class="py-5">
        <?php for ($i = 0; $i < count($conteudo); $i++) : ?>

            <a href="<?= base_url() ?>/conteudo/<?= $conteudo[$i]['id'] ?>" style="text-decoration: none;">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= base_url() ?>/imagens/<?= $conteudo[$i]['imagem'] ?>" class="img-fluid rounded-start" alt="<?= $conteudo[$i]['titulo'] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-body"><?= $conteudo[$i]['titulo'] ?></h5>
                                <p class="card-text text-body""><?= $conteudo[$i]['descricao'] ?></p>
                                <p class=" card-text text-body"><small class="text-muted">Escrito em:<?= $conteudo[$i]['created_at'] ?></small></p>
                                <p class="card-text text-body"><small class="text-muted">Atualizado em:<?= $conteudo[$i]['updated_at'] ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endfor; ?>
    </div>
</div>