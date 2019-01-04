<?php
// function to display number of posts.
function getPostViews($postID){
    $count_key = '_post_views_count';
    $count = get_post_meta($postID, $count_key, false);
    $number = sizeof($count);
    return $number; 
}
function getPostViewed($postID, $ip){
    $count_key = '_post_views_count';
    $count = get_post_meta($postID, $count_key, false);
    if (in_array($ip, $count)) {
        return true;
    }
    return false; 
}

// function to count views.
function setPostViews($postID, $ip) {
    $count_key = '_post_views_count';
    $count = get_post_meta($postID, $count_key, false);
    if (!in_array($ip, $count)) {
        add_post_meta($postID, $count_key, $ip);
    }
}


?>