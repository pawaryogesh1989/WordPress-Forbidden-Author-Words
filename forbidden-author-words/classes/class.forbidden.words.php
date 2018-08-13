<?php

class Forbidden_Author_Words {

    static $instance;

    //Constructor of the Class
    public function __construct() {

        self::$instance = $this;

        add_action('admin_menu', array($this, 'wp_forbidden_words_menu'));
        add_action('admin_init', array($this, 'wp_forbidden_words_settings'));
        add_action('transition_post_status', array($this, 'post_forbidden_author_words'), 10, 3);
        add_action('admin_notices', array($this, 'forbidden_words_message'));
    }

    public function wp_forbidden_words_menu() {
        add_menu_page('Forbidden Author Words', 'Forbidden Author Words', 'manage_options', 'forbidden-author-words', array($this, 'load_forbidden_words_page'), '', 85);
    }

    public function load_forbidden_words_page() {
        if (current_user_can('manage_options')) {
            if (file_exists(plugin_dir_path(__DIR__) . '/views/forbidden-words-settings.php')) {
                require plugin_dir_path(__DIR__) . '/views/forbidden-words-settings.php';
            } else {
                die('<br /><h3>Plugin Installation is Incomplete. Please install the plugin again or make sure you have copied all the plugin files.</h3>');
            }
        } else {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
    }

    public function wp_forbidden_words_settings() {

        register_setting('forbidden-author-words-group', 'forbidden_words');
        register_setting('forbidden-author-words-group', 'forbidden_title');
        register_setting('forbidden-author-words-group', 'forbidden_content');
        register_setting('forbidden-author-words-group', 'forbidden_notice');
    }

    public function post_forbidden_author_words($new_status, $old_status, $post) {

        if ($_REQUEST['action'] != "trash") {
            if ($new_status == "publish") {
                $title = strtolower($post->post_title);
                $content = strtolower($post->post_content);
                $author_restricted_words = get_option('forbidden_words');

                if ($author_restricted_words) {
                    $restricted_words = explode(",", $author_restricted_words);

                    foreach ($restricted_words as $restricted_word) {

                        if (get_option('forbidden_title') == "true" || get_option('forbidden_title') == "") {
                            if (preg_match('/\\b' . $restricted_word . '\\b/i', $title)) {
                                $author_post = array();
                                $author_post['ID'] = $post->ID;
                                $author_post['post_status'] = 'draft';
                                wp_update_post($author_post);
                                wp_die(__('Error: You have used a forbidden word "' . $restricted_word . '" in post title, <br /><b>Your Post Status is set to Draft. To Publish it please remove the forbidden words mentioned.</b>'));
                                return false;
                            }
                        }

                        if (get_option('forbidden_content') == "true" || get_option('forbidden_content') == "") {
                            if (preg_match('/\\b' . $restricted_word . '\\b/i', $content)) {
                                $author_post = array();
                                $author_post['ID'] = $post->ID;
                                $author_post['post_status'] = 'draft';
                                wp_update_post($author_post);
                                wp_die(__('Error: You have used a forbidden words "' . $restricted_word . '" in post content, <br /><b>Your Post Status is set to Draft. To Publish it please remove the forbidden words mentioned.</b>'));
                                return false;
                            }
                        }
                    }
                }
            }
        }
    }

    public function forbidden_words_message() {
        if (get_option('forbidden_notice') == "true" || get_option('forbidden_notice') == "") {
            ?>
            <div class="updated notice is-dismissible">
                <p><?php _e('The Following words are not accepted while adding or updating an Article/Post.<br /><b>' . get_option('forbidden_words') . '</b>'); ?></p>
            </div>
            <?php
        }
    }

}
