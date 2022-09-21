<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-5">

            <h2>Criar Conteudo</h2>

            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-warning">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url(); ?>/ConteudoController/store" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <input type="text" name="titulo" placeholder="Titulo" value="<?= set_value('titulo') ?>" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <textarea name="descricao" id="descricao" cols="30" rows="10" placeholder="Descrição" value="<?= set_value('descricao') ?>" class="form-control"></textarea>
                </div>
                <div class="form-group mb-3">
                    <textarea name="body" id="body" cols="30" rows="10" placeholder="Conteudo" value="<?= set_value('body') ?>" class="form-control"></textarea>
                </div>
                <div class="form-group mb-3">
                    <input type="file" name="imagem" placeholder="Imagem" class="form-control">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>

    </div>
</div>