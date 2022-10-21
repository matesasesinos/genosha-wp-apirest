<div class="genosha-meta-fields">
    <label for="">Subtitulo</label>
    <input type="text" name="project-subtitle" placeholder="Subtitulo del proyecto." value="<?php echo $subtitle ?>">
</div>
<div class="genosha-meta-fields">
    <label for="">Descripción</label>
    <textarea name="project-description" rows="5" placeholder="Breve descripción del proyecto."><?php echo $description ?></textarea>
</div>
<div class="genosha-meta-fields">
    <label for="">Link</label>
    <input type="url" name="project-link" placeholder="https://something.com" value="<?php echo $link ?>">
</div>
<div class="genosha-meta-fields">
    <label style="display: flex; justify-content:space-between; padding-top:1%">
        Archivo (GLTF)
        <?php if ($file_url && $file_url != '') : ?>
            <a href="<?php echo $file_url ?>" target="_blank" class="button" style="display:inline-block">Ver archivo actual</a>
        <?php endif; ?>
    </label>
    <div class="genosha-meta-upload" style="padding-bottom:1%">
        <input type="file" name="project-file" placeholder="Solo archivos GLTF">
        
        <?php if ($file_url && $file_url != '') : ?>
            <input type="hidden" name="project-file-url" value="<?php echo $file_url ?>">
            <input type="hidden" name="project-file-name" value="<?php echo $file_name ?>">
        <?php endif; ?>
    </div>
</div>
<?php wp_nonce_field('project_meta_boxes', 'project_meta_boxes_nonce'); ?>