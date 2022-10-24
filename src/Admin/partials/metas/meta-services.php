<div class="genosha-meta-fields genosha-meta-tags">
    <label for="">Tags</label>
    <input type="text" name="service-tag1" placeholder="Servicio tag 1" value="<?php echo $tag1?>">
    <input type="text" name="service-tag2" placeholder="Servicio tag 2" value="<?php echo $tag2?>">
    <input type="text" name="service-tag3" placeholder="Servicio tag 3" value="<?php echo $tag3?>">
    <input type="text" name="service-tag4" placeholder="Servicio tag 4" value="<?php echo $tag4?>">
</div>
<div class="genosha-meta-fields">
    <label for="">MP4</label>
    <div class="genosha-meta-upload genosha-meta-upload-2" style="padding-bottom:1%">
        <input type="file" name="services-file1" accept="video/mp4" placeholder="Solo archivos MP4">
        <input type="file" name="services-file2" accept="video/mp4" placeholder="Solo archivos MP4">
        <input type="hidden" name="service-file1-url" value="<?php echo $video1_url?>">
        <input type="hidden" name="service-file2-url" value="<?php echo $video2_url?>">
    </div>
</div>
<?php wp_nonce_field('service_meta_boxes', 'service_meta_boxes_nonce'); ?>