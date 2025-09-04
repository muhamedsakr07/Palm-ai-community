<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// This content i use the_content filter to add the post type meta box inside single post
function display_summary($content) {
    if (get_post_type() === 'community_discussion') {
        $summary = get_post_meta(get_the_ID(), 'community_summary', true);
        if ($summary) {
            $content .= '<div class="community_summary"><strong> Summary Discussion:</strong><p>' . esc_html($summary) . '</p></div>';
        }
    }
    return $content;
}
add_filter('the_content', 'display_summary');