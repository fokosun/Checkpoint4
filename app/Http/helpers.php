<?php

/**
 * Load asset
 * @param $asset_url
 * @return string
 */
function load_asset($asset_url) {
    return ( env('APP_ENV') === 'production' ) ? secure_asset($asset_url) : asset($asset_url);
}

/**
 * Create Slug
 *
 * @param $slug
 *
 * @return string
 */
function slugify($slug) {
    return str_replace(" ", "-", $slug);
}
