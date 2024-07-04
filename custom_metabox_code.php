<?php

/*
 * METABOXES
 *  */
function section_one_get_meta($value) {
    global $post;

    $field = get_post_meta($post->ID, $value, true);
    if (!empty($field)) {
        return is_array($field) ? stripslashes_deep($field) : stripslashes(wp_kses_decode_entities($field));
    } else {
        return false;
    }
}

function section_one_add_meta_box() {
    add_meta_box(
            'section_one-section-one', __('Section One', 'section_one'), 'section_one_html', 'project', 'normal', 'default'
    );
}

add_action('add_meta_boxes', 'section_one_add_meta_box');

function section_one_html($post){
    wp_nonce_field('_section_one_nonce', 'section_one_nonce');
     
    ?>
    <style>
        .disabled{display:none;}
        .enabled{display:block;}
    </style>
    <label><input type="checkbox" id="enable_s1" name="enable_s1" value="enabled"/> Enable?</label>
    <div id="s1" class="disabled">
        <p>
            <label for="section_one_heading"><?php _e('heading', 'section_one'); ?></label><br>
            <input type="text" name="section_one_heading" id="section_one_heading" value="<?php echo section_one_get_meta('section_one_heading'); ?>">
        </p>	
        <p>
            <label for="section_one_text"><?php _e('text', 'section_one'); ?></label><br>
            <textarea name="section_one_text" id="section_one_text" ><?php echo section_one_get_meta('section_one_text'); ?></textarea>

        </p>
    </div>     
    <script>
        (function ($) {
            $(document).ready(function () {


                if ($('#enable_s1').is(":not(:checked)")) {
                    console.log('unchecked');

                    $('#s1').addClass('disabled').removeClass('enabled');

                } else if ($('#enable_s1').is(":checked")) {
                    console.log('checked');

                    $('#s1').addClass('enabled').removeClass('disabled');

                }
                $('#enable_s1').click(function () {

                    if ($('#enable_s1').is(":not(:checked)")) {
                        console.log('unchecked');

                        $('#s1').addClass('disabled').removeClass('enabled');

                    } else if ($('#enable_s1').is(":checked")) {
                        console.log('checked');

                        $('#s1').addClass('enabled').removeClass('disabled');

                    }
                });


            });
        })(jQuery);

    </script>
    <?php
}

function section_one_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!isset($_POST['section_one_nonce']) || !wp_verify_nonce($_POST['section_one_nonce'], '_section_one_nonce'))
        return;
    if (!current_user_can('edit_post', $post_id))
        return;
    
    if (isset($_POST['section_one_heading']))
        update_post_meta($post_id, 'section_one_heading', esc_attr($_POST['section_one_heading']));
    if (isset($_POST['section_one_text']))
        update_post_meta($post_id, 'section_one_text', esc_attr($_POST['section_one_text']));
}

add_action('save_post', 'section_one_save');

