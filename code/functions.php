<?php
/*
  Copyright (C)2015 Mehmet Durgel

  This file is part of SiteBase.

  SiteBase is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  (at your option) any later version.

  SiteBase is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with SiteBase.  If not, see <http://www.gnu.org/licenses/>
 */
/**
 * __functions.php__
 *
 * @author Mehmet Durgel <md@legrud.net>
 * @date 30-05-2015
 * @time 14:31
 */

/**
 * All purpose render function
 */
function render($template, $data){
	if(!is_object($data))
	{
		return false;
	}
	ob_start();
	include PATH_VIEWS . $template;
	return ob_get_clean();
}

/**
 * Utility render function
 */
function utils($utility, $data, $parameters = array()){
	if(!is_object($data))
	{
		return false;
	}
	ob_start();
	$callback = include PATH_UTILS . $utility . EXT_PHTML;
	call_user_func_array($callback, $parameters);
	return ob_get_clean();
}

/**
 * Error Display function
 */
function showError($no, $message, $file, $line, $context){
	header('Content-type: text/plain');
	$error = array(
		'no' => $no,
		'message' => $message,
		'file' => $file,
		'line' => $line,
		'context' => $context
	);
	echo NL . $error['no'] . SP . CLN . SP . $error['message']
	. NL . SP . $error['file'] . DOT . $error['line'] . NL;
}

/**
 * Pages list and page meta data gathering function
 */
function pageslist($location){
	$metas = parse_ini_file($location . 'pages' . EXT_INI, true, INI_SCANNER_RAW);
	$pages = array();
	foreach($metas as $name => $meta){
		$page = $meta;
		$page['name'] = $name;
		if(isset($page['navigation']))
		{
			$page['navigation'] = explode(CLN, $page['navigation']);
		}
		else
		{
			$page['navigation'] = array();
		}
		if(isset($page['hidden']))
		{
			$page['hidden'] = explode(CLN, $page['hidden']);
		}
		$pages[$name] = $page;
	}
	return $pages;
}

/**
 * Base url determination function
 */
function baseURL(){
	$dirname = dirname($_SERVER['SCRIPT_NAME']);
	$external = explode(DS, trim($dirname, DS));
	$internal = explode(DS, trim(__DIR__, DS));
	$intersection = array_filter(array_intersect($external, $internal));
	$difference = array_filter(array_diff($external, $internal));
	$path = '';
	$path .= (count($difference) > 0) ? DS . implode(DS, $difference) : '';
	$path .= (count($intersection) > 0) ? DS . implode(DS, $intersection) : '';
	return "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}$path" . DS;
}

/**
 * Base uri determination function
 */
function baseURI(){
	$uri = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}";
	if($_SERVER['QUERY_STRING'])
	{
		$uri = str_replace($_SERVER['QUERY_STRING'], '', $uri);
	}
	return trim($uri, QS);
}
?>