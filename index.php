<?php
//
// AwesomeFramework - extremely simple framework.
//
// Copyright (C) 2005 Masaki Komagata <komagata@gmail.com>
//     All rights reserved.
//     This is free software with ABSOLUTELY NO WARRANTY.
//
// You can redistribute it and/or modify it under the terms of 
// the PHP License, version 3.0.
//
define('VERSION', '0.10.0');

// setting
define('DEFAULT_PAGE', 'default');
define('EXT', '.php');
define('PARAM', 'p');
define('DOCROOT_DIR', dirname(__FILE__) . '/');
define('ROOT_DIR', DOCROOT_DIR);
define('APP_DIR', ROOT_DIR);
define('LIB_DIR', ROOT_DIR);
define('CONF_FILE', ROOT_DIR . 'config.php');
define('INC_FILE', APP_DIR . 'include.php');
define('DOCROOT_DIR_URI', dirname($_SERVER['SCRIPT_NAME']) . '/');
define('ROOT_DIR_URI', DOCROOT_DIR_URI);
define('USE_TAGLIB', true);
// gnittes

$vars = array();

if (USE_TAGLIB) taglib();
if (file_exists(CONF_FILE)) include_once CONF_FILE;
if (file_exists(INC_FILE)) include_once INC_FILE;

session_start();
forward(isset($_REQUEST[PARAM]) ? $_REQUEST[PARAM] : DEFAULT_PAGE);

function forward($page)/*{{{*/
{
    $C = array();
    if (isset($GLOBALS['C'])) {
        $C = &$GLOBALS['C'];
    } elseif (is_string($conf = @include CONF_FILE)) {
        $C = $conf;
        unset($conf);
    }

    $R = &$_REQUEST;
    $S = &$_SESSION;
    extract($GLOBALS['vars']);
    $result = include APP_DIR . '/' . $page . EXT;
    if (is_string($result)) forward($result);
}/*}}}*/

function fetch($page)/*{{{*/
{
    ob_start();
    forward($page);
    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}/*}}}*/

function redirect($page, $params = array())/*{{{*/
{
    header('Location: ' . url($page, $params));
    exit();
}/*}}}*/

function url($page, $params = array())/*{{{*/
{
    $param = '';
    foreach ($params as $name => $value) {
        $param .= '&' . $name . '=' . $value;
    }
    return 'index.php?' . PARAM . '=' . $page . $param;
}/*}}}*/

function assign($name, $value)/*{{{*/
{
    $GLOBALS['vars'][$name] = $value;
}/*}}}*/

function assign_by_ref($name, &$value)/*{{{*/
{
    $GLOBALS['vars'][$name] =& $value;
}/*}}}*/

function get($name)/*{{{*/
{
    if (isset($$name)) {
        return $$name;
    }
}/*}}}*/

function taglib()/*{{{*/
{
    function html_options($options, $selected = null)/*{{{*/
    {
        $html = '';
        foreach ($options as $key => $value) {
            $select = $selected == $key ? ' selected="selected"' : '';
            $html .= "<option value=\"$key\"$select>$value</option>\n";
        }
        return $html;
    }/*}}}*/

    function html_radios($options, $selected = null)/*{{{*/
    {

    }/*}}}*/
}/*}}}*/
?>
