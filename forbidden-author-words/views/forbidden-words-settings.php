<div class="wrap">
    <h3><?php _e('Forbidden Author Words'); ?></h3>

    <form method="post" action="options.php">
        <?php settings_fields('forbidden-author-words-group'); ?>
        <?php do_settings_sections('forbidden-author-words-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e("Forbidden Author Words :"); ?></th>
                <td>
                    <textarea name="forbidden_words" rows="10" cols="80"><?php echo esc_attr(get_option('forbidden_words')); ?></textarea> <br />(Please give comma (,) between the words)
                </td>                
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Apply for Title :"); ?> <span style="font-size: 11px;">(By Default it is Enable)</span></th>
                <td>
                    <select class="regular-select" name="forbidden_title">
                        <option value="true" <?php selected(get_option('forbidden_title'), 'true'); ?>><?php _e("Enable"); ?></option>
                        <option value="false" <?php selected(get_option('forbidden_title'), 'false'); ?>><?php _e("Disable"); ?></option>                   
                    </select>
                </td>                
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Apply for Content :"); ?> <span style="font-size: 11px;">(By Default it is Enable)</span></th>
                <td>
                    <select class="regular-select" name="forbidden_content">
                        <option value="true" <?php selected(get_option('forbidden_content'), 'true'); ?>><?php _e("Enable"); ?></option>
                        <option value="false" <?php selected(get_option('forbidden_content'), 'false'); ?>><?php _e("Disable"); ?></option>                   
                    </select>
                </td>                
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e("Display Forbidden Notice :"); ?> <span style="font-size: 11px;">(By Default it is Enable)</span></th>
                <td>
                    <select class="regular-select" name="forbidden_notice">
                        <option value="true" <?php selected(get_option('forbidden_notice'), 'true'); ?>><?php _e("Enable"); ?></option>
                        <option value="false" <?php selected(get_option('forbidden_notice'), 'false'); ?>><?php _e("Disable"); ?></option>                   
                    </select>
                </td>                
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>