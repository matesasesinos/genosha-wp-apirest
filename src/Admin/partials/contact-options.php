<div class="wrap">
    <h1>Contacto</h1>
    <form method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>Email de contacto</th>
                    <td>
                        <input type="email" class="regular-text" name="genosha_contact_email" value="<?php echo get_option('genosha_contact_email', get_option('admin_email')) ?>">
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <button type="submit" class="button button-primary">Guardar</button>
        </p>
    </form>
    <hr>
    <h1>Redes sociales</h1>
    <?php $networks = maybe_unserialize( get_option('genosha_social_networks') ); ?>
    <form method="post" enctype="multipart/form-data">
        <div class="genosha-networks-form">
            <div class="genosha-meta-fields">
                <strong>Medium <img style="max-width: 24px;" src="<?php echo $networks['medium']['image']?>" alt=""></strong>
                <input type="url" name="nt-link-medium" value="<?php echo $networks['medium']['link']?>" placeholder="Link">
                <input type="file" name="nt-upload-medium">
                 <select name="nt-medium-active">
                    <option value="">¿Activar?</option>
                    <option value="1" <?php selected(1,$networks['medium']['active'], true)?>>SI</option>
                    <option value="0" <?php selected(0,$networks['medium']['active'], true)?>>NO</option>
                </select>
                <input type="hidden" name="nt-image-medium" value="<?php echo $networks['medium']['image']?>"> 
            </div>
            <div class="genosha-meta-fields">
                <strong>Twitter <img style="max-width: 24px;" src="<?php echo $networks['twitter']['image']?>" alt=""></strong>
                <input type="url" name="nt-link-twitter" value="<?php echo $networks['twitter']['link']?>" placeholder="Link">
                <input type="file" name="nt-upload-twitter">
                 <select name="nt-twitter-active">
                    <option value="">¿Activar?</option>
                    <option value="1" <?php selected(1,$networks['twitter']['active'], true)?>>SI</option>
                    <option value="0" <?php selected(0,$networks['twitter']['active'], true)?>>NO</option>
                </select>
                <input type="hidden" name="nt-image-twitter" value="<?php echo $networks['twitter']['image']?>">
            </div>
            <div class="genosha-meta-fields">
                <strong>Instagram <img style="max-width: 24px;" src="<?php echo $networks['instagram']['image']?>" alt=""></strong>
                <input type="url" name="nt-link-instagram" value="<?php echo $networks['instagram']['link']?>" placeholder="Link">
                <input type="file" name="nt-upload-instagram">
                <select name="nt-instagram-active">
                    <option value="">¿Activar?</option>
                    <option value="1" <?php selected(1,$networks['instagram']['active'], true)?>>SI</option>
                    <option value="0" <?php selected(0,$networks['instagram']['active'], true)?>>NO</option>
                </select>
                <input type="hidden" name="nt-image-instagram" value="<?php echo $networks['instagram']['image']?>">
            </div>
            <div class="genosha-meta-fields">
                <strong>Dribbble <img style="max-width: 24px;" src="<?php echo $networks['dribbble']['image']?>" alt=""></strong>
                <input type="url" name="nt-link-dribbble" value="<?php echo $networks['dribbble']['link']?>" placeholder="Link">
                <input type="file" name="nt-upload-dribbble">
                <select name="nt-dribbble-active">
                    <option value="">¿Activar?</option>
                    <option value="1" <?php selected(1,$networks['dribbble']['active'], true)?>>SI</option>
                    <option value="0" <?php selected(0,$networks['dribbble']['active'], true)?>>NO</option>
                </select>
                <input type="hidden" name="nt-image-dribbble" value="<?php echo $networks['dribbble']['image']?>">
            </div>
            <div class="genosha-meta-fields">
                <strong>Linkedin <img style="max-width: 24px;" src="<?php echo $networks['linkedin']['image']?>" alt=""></strong>
                <input type="url" name="nt-link-linkedin" value="<?php echo $networks['linkedin']['link']?>" placeholder="Link">
                <input type="file" name="nt-upload-linkedin">
                 <select name="nt-linkendin-active">
                    <option value="">¿Activar?</option>
                    <option value="1" <?php selected(1,$networks['linkedin']['active'], true)?>>SI</option>
                    <option value="0" <?php selected(0,$networks['linkedin']['active'], true)?>>NO</option>
                </select>
                <input type="hidden" name="nt-image-linkedin" value="<?php echo $networks['linkedin']['image']?>">
            </div>
            <div class="genosha-meta-fields">
                <strong>Youtube <img style="max-width: 24px;" src="<?php echo $networks['youtube']['image']?>" alt=""></strong>
                <input type="url" name="nt-link-youtube" value="<?php echo $networks['youtube']['link']?>" placeholder="Link">
                <input type="file" name="nt-upload-youtube">
                 <select name="nt-youtube-active">
                    <option value="">¿Activar?</option>
                    <option value="1" <?php selected(1,$networks['youtube']['active'], true)?>>SI</option>
                    <option value="0" <?php selected(0,$networks['youtube']['active'], true)?>>NO</option>
                </select>
                <input type="hidden" name="nt-image-youtube" value="<?php echo $networks['youtube']['image']?>">
            </div>
        </div>
        <p class="submit">
            <button type="submit" class="button button-primary" name="nt-save">Guardar</button>
        </p>
    </form>
</div>