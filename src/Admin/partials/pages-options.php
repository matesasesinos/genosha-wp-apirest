<div class="wrap">
    <h1>Paginas e Informaciones</h1>
    <?php $cookies = maybe_unserialize( get_option('genosha_cookies_policy') );?>
    <form method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>Texto de Cookies</th>
                    <td>
                        <strong>Ingles</strong>
                        <textarea class="large-text" name="genosha_cookies_text_en" rows="3"><?php echo $cookies['cookies_text_en']?></textarea>
                        <hr>
                        <strong>Español</strong>
                        <textarea class="large-text" name="genosha_cookies_text_es" rows="3"><?php echo $cookies['cookies_text_es']?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Página de Cookies</th>
                    <td>
                        <strong>Ingles</strong><br />
                        <?php if(genosha_get_pages('en')): ?>
                            <select name="genosha_cookies_page_en" class="regular-text">
                                <option value="">-- seleccionar --</option>
                                <?php foreach(genosha_get_pages('en') as $page): ?>
                                    <option value="<?php echo $page['ID']?>" <?php selected($page['ID'], $cookies['cookies_page_en'], true)?>><?php echo $page['title']?></option>
                                <?php endforeach?>
                            </select>
                        <?php else: ?>
                            Debe creare una página para el idioma Ingles primero.
                        <?php endif; ?>
                        <hr>
                        <strong>Español</strong><br />
                        <?php if(genosha_get_pages('es')): ?>
                            <select name="genosha_cookies_page_es" class="regular-text">
                                <option value="">-- seleccionar --</option>
                                <?php foreach(genosha_get_pages('es') as $page): ?>
                                    <option value="<?php echo $page['ID']?>" <?php selected($page['ID'], $cookies['cookies_page_es'], true)?>><?php echo $page['title']?></option>
                                <?php endforeach?>
                            </select>
                        <?php else: ?>
                            Debe creare una página para el idioma Español primero.
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <button class="button button-primary" name="genosha-cookies-save" type="submit">Guardar</button>
        </p>
    </form>
</div>