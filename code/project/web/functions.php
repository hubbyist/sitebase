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
function render($template, &$data){
	$closure = function($template, $data){
		if(!is_object($data))
		{
			return false;
		}
		include PATH_VIEWS . $template;
	};
	return createOutputWithClosure($closure, [$template, $data]);
}

/**
 * Utility render function
 */
function utils($utility, $parameters = array()){
	if(!is_array($parameters))
	{
		return false;
	}
	$closure = include PATH_UTILS . $utility . EXT_PHTML;
	return createOutputWithClosure($closure, $parameters);
}

/**
 * In buffer error checking function
 */
function createOutputWithClosure($closure, $variables){
	$error_count = $GLOBALS['ERROR_COUNT'];
	ob_start();
	call_user_func_array($closure, $variables);
	$output = ob_get_clean();
	//If an error occurs while creating output always echo the buffer
	if($error_count < $GLOBALS['ERROR_COUNT'])
	{
		echo $output;
	}
	return $output;
}

/**
 * Error Display function
 */
function showError($no, $message, $file, $line, $context){
	$GLOBALS['ERROR_COUNT'] ++;
	header('Content-Type: text/plain; charset=utf-8');
	$error = array(
		'no' => $no,
		'message' => $message,
		'file' => $file,
		'line' => $line,
		'context' => $context
	);
	echo NL . $error['no'] . SPC . CLN . SPC . $error['message']
	. NL . SPC . $error['file'] . DOT . $error['line'] . NL;
}

/**
 * ShutDown Function to catch fatal errors
 */
function ShowFatalError(){
	$error = error_get_last();
	if($error !== NULL)
	{
		call_user_func_array('showError', $error);
	}
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
		$page['path'] = baseURL();
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