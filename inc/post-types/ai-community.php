<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function register_community_discussion_post_type()
{

    $labels = array(
        "name" => __("Community Discussions", ""),
        "singular_name" => __("community_discussion", ""),
    );

    $args = array(
        "label" => __("Community Discussions", ""),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "query_var" => true,
        "supports" => array("title", "thumbnail" , 'editor')
    );

    register_post_type("community_discussion", $args);
}

add_action('init', 'register_community_discussion_post_type');

function community_discussion_add_meta_boxes($post)
{
    add_meta_box('community_discussion_meta_box', __('Community Discussion Details', 'community_discussion_plugin'), 'community_summary_build_meta_box', 'community_discussion', 'normal', 'high');
}
add_action('add_meta_boxes_community_discussion', 'community_discussion_add_meta_boxes');


function community_summary_build_meta_box($post)
{
    wp_nonce_field(basename(__FILE__), 'community_summary_meta_box_nonce');
    $community_summary = get_post_meta($post->ID, 'community_summary', true);

    ?>
    <div class='inside'>
        <h3><?php _e('Community Summary'); ?></h3>
        <div class="form-input">
            <textarea style="width: 100%" readonly name="community_summary" id="community_summary"><?php echo $community_summary; ?></textarea>
        </div>
        <div class="form-input">
        <input style="margin-top:20px" type="submit" class="button" name="generate_summary" value="Generate AI Summary" id="generate-summary-button" />

    <?php }

/**
 * Store community summary field meta box data
 * The Logic here we generate the content based on the post content
 * The post content shouldn't be empty
 * i avoid logic if content is empty (if empty i will return random text but this logic will not applied)
 * the bussiness for plugin will generate summary from post content only
 */

function community_summary_save_meta_box_data($post_id)
{
   
    if (!isset($_POST['community_summary_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['community_summary_meta_box_nonce'], basename(__FILE__))) {
        return;
    }
    
    $use_ajax = get_option('use_ajax_summary', 0);

    if ($use_ajax == 0 && isset($_POST['generate_summary'])) {
        $content = get_post_field('post_content', $post_id);
        $length = get_option('content_length', 4);
        $summary = wp_trim_words($content, $length, '..');
        update_post_meta($post_id, 'community_summary', sanitize_text_field($summary));
    }

}

add_action('save_post_community_discussion', 'community_summary_save_meta_box_data');


add_action('wp_ajax_generate_community_summary', 'ajax_generate_community_summary');

function ajax_generate_community_summary()
{
    
    check_ajax_referer('community_summary_ajax_nonce', 'security');

    $post_id = intval($_POST['post_id']);
    $length = get_option('content_length', 4);
    $content = get_post_field('post_content', $post_id);
    $summary = wp_trim_words($content, $length, '..');

    update_post_meta($post_id, 'community_summary', sanitize_text_field($summary));

    wp_send_json_success(['summary' => $summary]);
    
}