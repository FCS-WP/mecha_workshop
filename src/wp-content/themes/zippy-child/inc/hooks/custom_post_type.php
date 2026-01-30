<?php

/**
 * Custom Post Types
 */

// Register Project Custom Post Type
function create_project_post_type()
{
    $labels = array(
        'name'                  => _x('Projects', 'Post Type General Name', 'zippy-child'),
        'singular_name'         => _x('Project', 'Post Type Singular Name', 'zippy-child'),
        'menu_name'             => __('Projects', 'zippy-child'),
        'name_admin_bar'        => __('Project', 'zippy-child'),
        'archives'              => __('Project Archives', 'zippy-child'),
        'attributes'            => __('Project Attributes', 'zippy-child'),
        'parent_item_colon'     => __('Parent Project:', 'zippy-child'),
        'all_items'             => __('All Projects', 'zippy-child'),
        'add_new_item'          => __('Add New Project', 'zippy-child'),
        'add_new'               => __('Add New', 'zippy-child'),
        'new_item'              => __('New Project', 'zippy-child'),
        'edit_item'             => __('Edit Project', 'zippy-child'),
        'update_item'           => __('Update Project', 'zippy-child'),
        'view_item'             => __('View Project', 'zippy-child'),
        'view_items'            => __('View Projects', 'zippy-child'),
        'search_items'          => __('Search Project', 'zippy-child'),
        'not_found'             => __('Not found', 'zippy-child'),
        'not_found_in_trash'    => __('Not found in Trash', 'zippy-child'),
        'featured_image'        => __('Featured Image', 'zippy-child'),
        'set_featured_image'    => __('Set featured image', 'zippy-child'),
        'remove_featured_image' => __('Remove featured image', 'zippy-child'),
        'use_featured_image'    => __('Use as featured image', 'zippy-child'),
        'insert_into_item'      => __('Insert into project', 'zippy-child'),
        'uploaded_to_this_item' => __('Uploaded to this project', 'zippy-child'),
        'items_list'            => __('Projects list', 'zippy-child'),
        'items_list_navigation' => __('Projects list navigation', 'zippy-child'),
        'filter_items_list'     => __('Filter projects list', 'zippy-child'),
    );

    $args = array(
        'label'                 => __('Project', 'zippy-child'),
        'description'           => __('Project custom post type', 'zippy-child'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'revisions', 'custom-fields'),
        'taxonomies'            => array('project_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
        'rewrite'               => array('slug' => 'projects'),
    );

    register_post_type('project', $args);
}
add_action('init', 'create_project_post_type', 0);

// Register Project Category Taxonomy
function create_project_category_taxonomy()
{
    $labels = array(
        'name'                       => _x('Project Categories', 'Taxonomy General Name', 'zippy-child'),
        'singular_name'              => _x('Project Category', 'Taxonomy Singular Name', 'zippy-child'),
        'menu_name'                  => __('Categories', 'zippy-child'),
        'all_items'                  => __('All Categories', 'zippy-child'),
        'parent_item'                => __('Parent Category', 'zippy-child'),
        'parent_item_colon'          => __('Parent Category:', 'zippy-child'),
        'new_item_name'              => __('New Category Name', 'zippy-child'),
        'add_new_item'               => __('Add New Category', 'zippy-child'),
        'edit_item'                  => __('Edit Category', 'zippy-child'),
        'update_item'                => __('Update Category', 'zippy-child'),
        'view_item'                  => __('View Category', 'zippy-child'),
        'separate_items_with_commas' => __('Separate categories with commas', 'zippy-child'),
        'add_or_remove_items'        => __('Add or remove categories', 'zippy-child'),
        'choose_from_most_used'      => __('Choose from the most used', 'zippy-child'),
        'popular_items'              => __('Popular Categories', 'zippy-child'),
        'search_items'               => __('Search Categories', 'zippy-child'),
        'not_found'                  => __('Not Found', 'zippy-child'),
        'no_terms'                   => __('No categories', 'zippy-child'),
        'items_list'                 => __('Categories list', 'zippy-child'),
        'items_list_navigation'      => __('Categories list navigation', 'zippy-child'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true, // Like categories (not tags)
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true, // Enable Gutenberg editor
        'rewrite'                    => array('slug' => 'project-category'),
    );

    register_taxonomy('project_category', array('project'), $args);
}
add_action('init', 'create_project_category_taxonomy', 0);

// Register Package Custom Post Type
function create_package_post_type()
{
    $labels = array(
        'name'                  => _x('Packages', 'Post Type General Name', 'zippy-child'),
        'singular_name'         => _x('Package', 'Post Type Singular Name', 'zippy-child'),
        'menu_name'             => __('Packages', 'zippy-child'),
        'name_admin_bar'        => __('Package', 'zippy-child'),
        'archives'              => __('Package Archives', 'zippy-child'),
        'attributes'            => __('Package Attributes', 'zippy-child'),
        'parent_item_colon'     => __('Parent Package:', 'zippy-child'),
        'all_items'             => __('All Packages', 'zippy-child'),
        'add_new_item'          => __('Add New Package', 'zippy-child'),
        'add_new'               => __('Add New', 'zippy-child'),
        'new_item'              => __('New Package', 'zippy-child'),
        'edit_item'             => __('Edit Package', 'zippy-child'),
        'update_item'           => __('Update Package', 'zippy-child'),
        'view_item'             => __('View Package', 'zippy-child'),
        'view_items'            => __('View Packages', 'zippy-child'),
        'search_items'          => __('Search Package', 'zippy-child'),
        'not_found'             => __('Not found', 'zippy-child'),
        'not_found_in_trash'    => __('Not found in Trash', 'zippy-child'),
        'featured_image'        => __('Featured Image', 'zippy-child'),
        'set_featured_image'    => __('Set featured image', 'zippy-child'),
        'remove_featured_image' => __('Remove featured image', 'zippy-child'),
        'use_featured_image'    => __('Use as featured image', 'zippy-child'),
        'insert_into_item'      => __('Insert into package', 'zippy-child'),
        'uploaded_to_this_item' => __('Uploaded to this package', 'zippy-child'),
        'items_list'            => __('Packages list', 'zippy-child'),
        'items_list_navigation' => __('Packages list navigation', 'zippy-child'),
        'filter_items_list'     => __('Filter packages list', 'zippy-child'),
    );

    $args = array(
        'label'                 => __('Package', 'zippy-child'),
        'description'           => __('Package custom post type', 'zippy-child'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author', 'revisions', 'custom-fields'),
        'taxonomies'            => array('package_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-cart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
        'rewrite'               => array('slug' => 'packages'),
    );

    register_post_type('package', $args);
}
add_action('init', 'create_package_post_type', 0);

// Register Package Category Taxonomy
function create_package_category_taxonomy()
{
    $labels = array(
        'name'                       => _x('Package Categories', 'Taxonomy General Name', 'zippy-child'),
        'singular_name'              => _x('Package Category', 'Taxonomy Singular Name', 'zippy-child'),
        'menu_name'                  => __('Categories', 'zippy-child'),
        'all_items'                  => __('All Categories', 'zippy-child'),
        'parent_item'                => __('Parent Category', 'zippy-child'),
        'parent_item_colon'          => __('Parent Category:', 'zippy-child'),
        'new_item_name'              => __('New Category Name', 'zippy-child'),
        'add_new_item'               => __('Add New Category', 'zippy-child'),
        'edit_item'                  => __('Edit Category', 'zippy-child'),
        'update_item'                => __('Update Category', 'zippy-child'),
        'view_item'                  => __('View Category', 'zippy-child'),
        'separate_items_with_commas' => __('Separate categories with commas', 'zippy-child'),
        'add_or_remove_items'        => __('Add or remove categories', 'zippy-child'),
        'choose_from_most_used'      => __('Choose from the most used', 'zippy-child'),
        'popular_items'              => __('Popular Categories', 'zippy-child'),
        'search_items'               => __('Search Categories', 'zippy-child'),
        'not_found'                  => __('Not Found', 'zippy-child'),
        'no_terms'                   => __('No categories', 'zippy-child'),
        'items_list'                 => __('Categories list', 'zippy-child'),
        'items_list_navigation'      => __('Categories list navigation', 'zippy-child'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true, // Like categories (not tags)
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true, // Enable Gutenberg editor
        'rewrite'                    => array('slug' => 'package-category'),
    );

    register_taxonomy('package_category', array('package'), $args);
}
add_action('init', 'create_package_category_taxonomy', 0);
