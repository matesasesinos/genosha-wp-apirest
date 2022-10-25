<div class="wrap">
    <h1>Skybox</h1>
    <a href="<?php echo GENOSHA_ADMIN_ASSETS_IMAGES ?>/skybox.png" target="_blank">Imágen de referencia</a>
    <?php $images = maybe_unserialize(get_option('skybox_images'));?>
    <?php if (isset($_GET['error_field'])) : ?>
        <div id="skybox-messages">
            <?php if ($_GET['error_field'] == 'empty') : ?>
                <p class="error">Falta una de las imagenes.</p>
            <?php endif; ?>
            <?php if ($_GET['error_field'] == 'save_error') : ?>
                <p class="error">Ocurrio un error al guardar.</p>
            <?php endif; ?>
            <?php if ($_GET['error_field'] == 'error_upload') : ?>
                <p class="error">Una de las imagenes no se pudo subir.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])) : ?>
        <div id="skybox-messages">
            <?php if ($_GET['success'] == 'saved') : ?>
                <p class="success">Guardado.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>Imágen Top</th>
                    <td>
                        <input type="file" name="skybox-top">
                        <input type="hidden" name="skybox-top-img" value="<?php echo $images ? $images['top'] : ''?>">
                        <?php echo $images ? '<a href="'.$images['top'].'" class="button" target="_blank">Ver Imágen Top</a>' : ''?>
                    </td>
                </tr>
                <tr>
                    <th>Imágen Left</th>
                    <td>
                        <input type="file" name="skybox-left">
                        <input type="hidden" name="skybox-left-img" value="<?php echo $images ? $images['left'] : ''?>">
                        <?php echo $images ? '<a href="'.$images['left'].'" class="button" target="_blank">Ver Imágen Left</a>' : ''?>
                    </td>
                </tr>
                <tr>
                    <th>Imágen Front</th>
                    <td>
                        <input type="file" name="skybox-front">
                        <input type="hidden" name="skybox-front-img" value="<?php echo $images ? $images['front'] : ''?>">
                        <?php echo $images ? '<a href="'.$images['front'].'" class="button" target="_blank">Ver Imágen Front</a>' : ''?>
                    </td>
                </tr>
                <tr>
                    <th>Imágen Right</th>
                    <td>
                        <input type="file" name="skybox-right">
                        <input type="hidden" name="skybox-right-img" value="<?php echo $images ? $images['right'] : ''?>">
                        <?php echo $images ? '<a href="'.$images['right'].'" class="button" target="_blank">Ver Imágen Right</a>' : ''?>
                    </td>
                </tr>
                <tr>
                    <th>Imágen Back</th>
                    <td>
                        <input type="file" name="skybox-back">
                        <input type="hidden" name="skybox-back-img" value="<?php echo $images ? $images['back'] : ''?>">
                        <?php echo $images ? '<a href="'.$images['back'].'" class="button" target="_blank">Ver Imágen Back</a>' : ''?>
                    </td>
                </tr>
                <tr>
                    <th>Imágen Bottom</th>
                    <td>
                        <input type="file" name="skybox-bottom">
                        <input type="hidden" name="skybox-bottom-img" value="<?php echo $images ? $images['bottom'] : ''?>">
                        <?php echo $images ? '<a href="'.$images['bottom'].'" class="button" target="_blank">Ver Imágen Bottom</a>' : ''?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field('skybox', 'skybox_nonce'); ?>
        <p class="submit">
            <button class="button button-primary" name="saves-skybox">Guardar</button>
        </p>
    </form>
</div>