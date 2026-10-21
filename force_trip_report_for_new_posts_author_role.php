add_action('wp_insert_post', 'set_default_category_for_authors', 10, 3);

function set_default_category_for_authors($post_id, $post, $update) {
    // Only run on standard blog posts
    if ($post->post_type !== 'post') {
        return;
    }

    // Do not run on existing post updates (only new posts)
    if ($update) {
        return;
    }

    // Target Category ID (Set target_category_id to your actual 'Trip Report' Category ID)
    $target_category_id = 4;

    // Check author role
    $author = get_userdata($post->post_author);
    if ($author && in_array('author', (array) $author->roles)) {
        
        // Append category without removing any manually selected ones
        wp_set_post_categories($post_id, array($target_category_id), true);
    }
    // Do the same thing for the editor role
    if ($author && in_array('editor', (array) $author->roles)) {

        // Append category without removing any manually selected ones
        wp_set_post_categories($post_id, array($target_category_id), true);
    }
}
//************************************************************
//************************************************************



//quigend