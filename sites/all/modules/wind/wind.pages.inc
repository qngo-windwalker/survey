<?php
// $Id$

/**
 * @file
 *
 * Menu callbacks for Wind module.
 */

/**
 * Page callback function for user/%user/wind menu path
 */
function wind_user_page($arguments){
    return 'Role : ' . $arguments->name;
}