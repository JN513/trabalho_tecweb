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
            <?php if (!empty($user['avatar'])) : ?>
                <img src="<?= base_url() ?>/imagens/<?= $user['avatar'] ?>" alt="<?= $user['first_name'] ?>" class="img-fluid">
            <?php else : ?>
                <img src="https://robohash.org/stefan-one" alt="<?= $user['first_name'] ?>" class="img-fluid">
            <?php endif; ?>
            <h3><?= $user['first_name'] ?></h3>
            <h3><?= $user['last_name'] ?></h3>
            <p><?= $user['email'] ?></p>
        </div>
        <div class="card-footer">
            <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-row-reverse py-3">
                    <?php if ($user['id'] == session()->get('id') or session()->get('is_staff')) : ?>
                        <a href="<?= base_url() ?>/user/edit/<?= $user['id'] ?>" class="btn btn-primary mx-1">Editar</a>
                        <a href="<?= base_url() ?>/user/delete/<?= $user['id'] ?>" class="btn btn-danger mx-1">Deletar</a>
                    <?php endif; ?>
                    <?php if ($user['id'] == session()->get('id')) : ?>
                        <a href="<?= base_url() ?>/user/alterpassword" class="btn btn-success mx-1">Alterar Senha</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (count($conteudo) != 0) : ?>
        <h3 class="py-3">Publicações:</h3>

        <div class="my-3">
            <form action="<?php if (isset($_REQUEST['page'])) echo "?page{$_REQUEST['page']}"; ?>" method="get">
                <div class="form-group">
                    <label for="orderby">Ordenar por:</label>
                    <select name="orderby" id="orderby" class="form-select" aria-label="Ordenar por:">
                        <option value="id" <?php if (!empty($_REQUEST['orderby'])) if ($_REQUEST['orderby'] == 'id') echo "selected" ?>>Data de publicação</option>
                        <option value="titulo" <?php if (!empty($_REQUEST['orderby'])) if ($_REQUEST['orderby'] == 'titulo') echo "selected" ?>>Titulo</option>
                        <option value="descricao" <?php if (!empty($_REQUEST['orderby'])) if ($_REQUEST['orderby'] == 'descricao') echo "selected" ?>>Descrição</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reverse">Ordem:</label>
                    <select name="reverse" id="reverse" class="form-select" aria-label="Ordem:">
                        <option value="1" <?php if (!empty($_REQUEST['reverse'])) if ($_REQUEST['reverse'] == '1') echo "selected" ?>>Crescente</option>
                        <option value="2" <?php if (!empty($_REQUEST['reverse'])) if ($_REQUEST['reverse'] == '2') echo "selected" ?>>Decrescente</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success">Ordenar</button>
                </div>
            </form>
        </div>

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
                                    <p class="card-text text-body"><?= $conteudo[$i]['descricao'] ?></p>
                                    <p class="card-text text-body"><small class="text-muted">Escrito em:<?= $conteudo[$i]['created_at'] ?></small></p>
                                    <p class="card-text text-body"><small class="text-muted">Atualizado em:<?= $conteudo[$i]['updated_at'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-warning">
            Não há conteúdo cadastrado.
        </div>
    <?php endif; ?>

    <?php
    $orderby = "";
    $reverse = "";

    if (isset($_REQUEST['orderby'])) {
        $orderby = "&orderby={$_REQUEST['orderby']}";
    }

    if (isset($_REQUEST['reverse'])) {
        $reverse = "&reverse={$_REQUEST['reverse']}";
    }

    $pagina = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1;

    $anterior = $pagina - 1;
    $proximo = $pagina + 1;

    ?>

    <div class="d-flex justify-content-center">
        <div>
            <ul class="pagination">
                <?php if ($pagina > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo "{$anterior}{$reverse}{$orderby}"; ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Anterior</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <?php if ($i == $pagina) : ?>
                        <li class="page-item active"><a class="page-link" href="?page=<?php echo "{$i}{$reverse}{$orderby}"; ?>"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo "{$i}{$reverse}{$orderby}"; ?>"><?= $i ?></a></li>
                    <?php endif; ?>

                <?php endfor; ?>
                <?php if ($pagina < $total_pages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo "{$proximo}{$reverse}{$orderby}"; ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>