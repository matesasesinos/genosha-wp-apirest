<div class="wrap">
    <h1>Skybox Tarjeta</h1>
    <?php $card = maybe_unserialize( get_option('skybox_card') );?>
    <?php if (isset($_GET['error'])) : ?>
        <div id="skybox-messages">
            <?php if ($_GET['error'] == 'empty') : ?>
                <p class="error">Falta la imagen.</p>
            <?php endif; ?>
            <?php if ($_GET['error'] == 'saved') : ?>
                <p class="error">Ocurrio un error al guardar.</p>
            <?php endif; ?>
            <?php if ($_GET['error'] == 'upload') : ?>
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
            <tr>
                <th>Texto de arriba</th>
                <td>
                    <p><strong>Inglés</strong></p>
                    <?php 
                        $settings = array(
                            'textarea_name' => 'skybox-card-title-en',
                            'media_buttons' => false,
                            'textarea_rows' => 3,
                            'teeny' => true,
                            'quicktags' => false,
                            'tinymce' => array(
                                'theme_advanced_buttons1' => 'bold,italic,underline'
                            )
                        );
                    ?>
                    <?php wp_editor($card ? $card['title_en'] : 'This page has a background generated with Artificial Intelligence. Powered by <strong>Dalle 2</strong>', 'skybox-card-title-en', $settings );?>
                    <hr>
                    <p><strong>Español</strong></p>
                    <?php 
                        $settings = array(
                            'textarea_name' => 'skybox-card-title-es',
                            'media_buttons' => false,
                            'textarea_rows' => 3,
                            'teeny' => true,
                            'quicktags' => false,
                            'tinymce' => array(
                                'theme_advanced_buttons1' => 'bold,italic,underline'
                            )
                        );
                    ?>
                    <?php wp_editor($card ? $card['title_es'] :'Esta página cuenta con un fondo generado con Inteligencia Artificial. Powered by <strong>Dalle 2</strong>', 'skybox-card-title-es', $settings );?>
                </td>
            </tr>
            <tr>
                <th>Imágen</th>
                <td>
                    <?php $image_skybox = $card ? $card['image'] : '';?>
                    <input type="file" name="skybox-card-image">
                    <input type="hidden" name="skybox-card-image-url" value="<?php echo $image_skybox?>">
                    <?php echo $image_skybox != '' ? '<a href="'.$image_skybox.'" target="_blank" class="button">Ver imagen actual</a>' : ''?>
                </td>
            </tr>
            <tr>
                <th>Autor</th>
                <td>
                     <select name="skybox-card-author">
                        <?php $author = $card ? $card['author'] : '';?>
                        <option value="">-- seleccionar --</option>
                        <?php  foreach(genosha_team_query() as $team): ?>
                            <option value="<?php echo $team['ID']?>" <?php selected($team['ID'], $author, true)?>><?php echo $team['name']?></option>
                        <?php endforeach?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Autor Frase</th>
                <td>
                    <p><strong>Inglés</strong></p>
                    <textarea name="skybox-card-author-text-en" class="large-text" rows="5"><?php echo $card ? $card['author_text_en'] : ''?></textarea>
                    <hr>
                    <p><strong>Español</strong></p>
                    <textarea name="skybox-card-author-text-es" class="large-text" rows="5"><?php echo $card ? $card['author_text_es'] : ''?></textarea>
                </td>
            </tr>
        </table>
        <?php wp_nonce_field('skybox_card', 'skybox_card_nonce'); ?>
        <p class="submit">
            <button type="submit" class="button button-primary">Guardar</button>
        </p>
    </form>
</div>