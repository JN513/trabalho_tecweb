<div class="container">
    <div class="bg-light py-5 px-3">
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

        <?php if ($conteudo['user_id'] == session()->get('id')) : ?>
            <div class="d-flex flex-row-reverse py-3">
                <a href="<?= base_url() ?>/conteudo/edit/<?= $conteudo['id'] ?>" class="btn btn-primary mx-1">Editar</a>
                <a href="<?= base_url() ?>/conteudo/delete/<?= $conteudo['id'] ?>" class="btn btn-danger mx-1">Deletar</a>
            </div>
        <?php endif; ?>

        <div class="text-center">
            <img src="<?= base_url() ?>/imagens/<?= $conteudo['imagem'] ?>" alt="<?= $conteudo['titulo'] ?>" class="img-fluid">
        </div>
        <div class="text-center py-2">
            <h1><?= $conteudo['titulo'] ?></h1>
        </div>
        <p><?= $conteudo['descricao'] ?></p>
        <p><?= $conteudo['body'] ?></p>
        <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">
                <p><small><em>Escrito em: <?= $conteudo['created_at'] ?> por <a href="/profile/<?= $user["id"] ?>" style="text-decoration: none;"><?= $user['first_name'] ?> <?= $user['last_name'] ?></a></em></small></p>
                <p><small><em>Atualizado em: <?= $conteudo['updated_at'] ?></em></small></p>
            </div>
        </div>
    </div>
</div>