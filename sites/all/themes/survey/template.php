<?php

/**
 * @file
 * template.php
 */

/**
 * Implementation of hook_preprocess_page()
 * @param $vars
 */
function survey_preprocess_page(&$vars, $hook){
    switch($hook)
    {
        case 'page' :
            if (arg(0) == 'node')
            {
                $vars['theme_hook_suggestions'][]  = 'page__' . $vars['node']->type;
                $vars['theme_hook_suggestions'][] = "page__" . $vars['node']->type . "__" . $vars['node']->nid;
            }
            break;
    }
//    debug($vars['theme_hook_suggestions']);
}
/**/