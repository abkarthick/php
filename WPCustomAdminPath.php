<?php
function custom_admin_url()
{
    return '/new-admin-url/';
}
add_filter('admin_url', 'custom_admin_url');
