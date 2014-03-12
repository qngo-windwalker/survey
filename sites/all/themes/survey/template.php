<?php

/**
 * Must comment out on production !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */
system_rebuild_theme_data();
// Rebuild theme registry.
drupal_theme_rebuild();

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function basic_preprocess_node(&$variables, $hook) {
    // Add $post_link variable.
//    print_r($variables);

//    $content_src = $variables['field_link'][0]['value'];
//    print_r($variables['field_link']);
    $content_src = '';
    if (empty($variables['field_link'])){
        $content_src = '';
    } else
    {
        $img_src = $variables['field_link']['und'][0]['value']; // hidden field.
        $content_src = '<img width="458px" src="' . $img_src . '" />';

    }
    $variables['content_src'] = $content_src;
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
function basic_preprocess_comment(&$variables, $hook) {

    // Add pubdate to submitted variable.
    $variables['node_link'] = 'testing';
}
 */

/**
 * Preprocess function for the number_up_down template.
function basic_preprocess_rate_template_number_up_down(&$variables) {

    //  [up_button] => <a class="rate-button rate-number-up-down-btn-up rate-voted" id="rate-button-3" rel="nofollow" href="/workspace/quan/picture/frontpage?rate=P0SsLQ1_nV5wOiBKdyK9Yk9rEdLLiYEvjlS9DM_eHrY" title="+1">+1</a>
    // [down_button] => <a class="rate-button rate-number-up-down-btn-down" id="rate-button-4" rel="nofollow" href="/workspace/quan/picture/frontpage?rate=JnAUjrBT9Eb3dp5Kl_3Wz7rrjmVYq4hzVdctEN0YBQo" title="-1">-1</a>
    $variables['up_button'] = <a class="rate-button rate-number-up-down-btn-up rate-voted" id="rate-button-3" rel="nofollow" href="/workspace/quan/picture/frontpage?rate=P0SsLQ1_nV5wOiBKdyK9Yk9rEdLLiYEvjlS9DM_eHrY" title="+1">+1</a>;
    print_r($variables);
}
 */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function strongchoices_preprocess_html(&$variables, $hook)
{
	$alias = drupal_get_path_alias();
	$alias = ($alias == 'node/1') ? 'home' : $alias;
	$variables['path_to_theme'] = path_to_theme();
	$variables['page_alias'] = $alias;
	
	/*
	 * Get the node type to use html--comic_page.tpl.php only on the comic page.
	 */
	//echo '<pre>';
	//print_r($variables['page']['content']['system_main']['nodes']);
	if (isset($variables['page']['content']['system_main']['nodes']))
	{
		$node_id = key($variables['page']['content']['system_main']['nodes']);
		$body_array = $variables['page']['content']['system_main']['nodes'][$node_id];
		
		if (isset($body_array['#node']->type) && $body_array['#node']->type == 'comic_page') 
	  	{
		    $variables['theme_hook_suggestions'][] = 'html__' . $body_array['#node']->type;
	  	}
	}
	//print_r($body_array);
	// print_r($body_array['#node']->type);
	// echo '</pre>';
}

/**
 * Override or insert variables into the page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function strongchoices_preprocess_page(&$variables, $hook)
{	
    // If this page has a node. Not all pages have it such as /user.
    if (isset($variables['node']) && isset($variables['node']->field_right_sidebar) && isset($variables['node']->field_right_sidebar['und']))
    {
        // Declare '$right_sidebar' if it's existed or has content otherwise set it to empty.
	    $variables['right_sidebar'] = $variables['node']->field_right_sidebar['und'][0]['value'];
    }
    else
    {
        $variables['right_sidebar'] = '';
    }

	$variables['secondary_menu_links'] = '';
	if (isset($variables['secondary_menu']))
	{
		$variables['secondary_menu_links'] = theme('links__system_secondary_menu', array(
			'links' => $variables['secondary_menu'],
			'attributes' => array(
				'id' => 'secondary-menu',
				'class' => array('inline', 'secondary-menu'),
			),
			'heading' => array(
				'text' => t('Secondary menu'),
				'level' => 'h2',
				'class' => array('element-invisible'),
			),
				));
	}
	
	if (isset($variables['secondary_menu'])) 
	{
	    $variables['secondary_nav'] = theme('links__system_secondary_menu', array(
	      'links' => $variables['secondary_menu'],
	      'attributes' => array(
	        'class' => array('links', 'inline', 'secondary-menu'),
	      ),
	      'heading' => array(
	        'text' => t('Secondary menu'),
	        'level' => 'h2',
	        'class' => array('element-invisible'),
	      )
	    ));
  	}
  	else 
  	{
    	$variables['secondary_nav'] = FALSE;
  	}
  	  
  // Creating template per content type
  if (isset($variables['node']->type)) 
  {
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
}

/*
 * Customizing login page.
 * More info can be found at: http://drupal.org/node/350634
 * 
function strongchoices_theme() {
  $items = array();
    
  $items['user_login'] = array(
    'render element' => 'form',
    'template' => 'user-login',
    'preprocess functions' => array(
       'strongchoices_preprocess_user_login'
    ),
  );
  $items['user_register_form'] = array(
    'render element' => 'form',
    'template' => 'user-register-form',
    'preprocess functions' => array(
      'strongchoices_preprocess_user_register_form'
    ),
  );
  
  return $items;
}

function strongchoices_preprocess_user_login(&$vars) {
	$vars['intro_text'] = t('This is my awesome login form');
}

function strongchoices_preprocess_user_register_form(&$vars) {
  $vars['intro_text'] = t('This is my super awesome reg form');
}
 */

/**
 * Return a themed breadcrumb trail.
 *
 * @param $variables
 *   - title: An optional string to be used as a navigational heading to give
 *     context for breadcrumb links to screen-reader users.
 *   - title_attributes_array: Array of HTML attributes for the title. It is
 *     flattened into a string within the theme function.
 *   - breadcrumb: An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function strongchoices_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('strongchoices_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {

    // Optionally get rid of the homepage link.
    $show_breadcrumb_home = theme_get_setting('strongchoices_breadcrumb_home');
    if (!$show_breadcrumb_home) {
      array_shift($breadcrumb);
    }

    // Return the breadcrumb with separators.
    if (!empty($breadcrumb)) {
      $breadcrumb_separator = theme_get_setting('strongchoices_breadcrumb_separator');
      $trailing_separator = $title = '';
      if (theme_get_setting('strongchoices_breadcrumb_title')) {
        $item = menu_get_item();
        if (!empty($item['strongchoices_parent'])) {
          // If we are on a non-default tab, use the tab's title.
          $title = check_plain($item['title']);
        }
        else {
          $title = drupal_get_title();
        }
        if ($title) {
          $trailing_separator = $breadcrumb_separator;
        }
      }
      elseif (theme_get_setting('strongchoices_breadcrumb_trailing')) {
        $trailing_separator = $breadcrumb_separator;
      }

      // Provide a navigational heading to give context for breadcrumb links to
      // screen-reader users.
      if (empty($variables['title'])) {
        $variables['title'] = t('You are here');
      }
      // Unless overridden by a preprocess function, make the heading invisible.
      if (!isset($variables['title_attributes_array']['class'])) {
        $variables['title_attributes_array']['class'][] = 'element-invisible';
      }
      $heading = '<h2' . drupal_attributes($variables['title_attributes_array']) . '>' . $variables['title'] . '</h2>';

      return '<div class="breadcrumb">' . $heading . implode($breadcrumb_separator, $breadcrumb) . $trailing_separator . $title . '</div>';
    }
  }
  // Otherwise, return an empty string.
  return '';
}

