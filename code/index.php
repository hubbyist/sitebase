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
 * __index.php__
 *
 * @author Mehmet Durgel <md@legrud.net>
 * @date 30-05-2015
 * @time 14:29
 */
define('INSITE', true);
header("Content-Type: text/html; charset=utf-8");
mb_internal_encoding('utf-8');

//Define Library Path
define('PATH_LIBRARY', 'library/');

//Get Common Constants
require_once PATH_LIBRARY . 'constants.php';

//Get Common Functions
require_once PATH_LIBRARY . 'functions.php';

//Get Site Paths
require_once 'paths.php';

//Get Site Functions
require_once 'functions.php';

//Register error handler function
$GLOBALS['ERROR_COUNT'] = 0;
set_error_handler('showError');

//Register shutdown function to handle fatal errors
register_shutdown_function('ShowFatalError');

//Create and initialize common data registry object
$data = new stdClass();
$data->admin = false;
$data->pagename = false;
$data->page = false;
$data->template = false;
$data->content = false;
$data->warnings = array();
$data->layout = 'main';
$data->language = 'en';

//Load Site Config
loadConfig(PATH_SITE, 'site', $data);

//Get pages list
$data->pages = pageslist(PATH_PAGES);

//Determine request path
$data->baseURL = baseURL();
$path = trim(str_replace($data->baseURL, '', baseURI()));

//Determine request target
$data->target = explode(DS, str_replace(EXT_HTML, '', $path));
//Determine request type
$service_path = PATH_SERVICES . $data->target[0] . EXT_PHP;
if(file_exists($service_path))
{
	//Get request method
	$data->method = $_SERVER['REQUEST_METHOD'];
	if(isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']))
	{
		$data->method = strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
	}

	//Set service name
	$data->servicename = $data->target[0];
	include_once $service_path;
}
if($data->target)
{
	//Set page name
	if(!$data->target[0])
	{
		$data->pagename = 'index';
	}
	elseif(array_key_exists($data->target[0], $data->pages))
	{
		$data->pagename = $data->target[0];
	}

	//Gather page data
	if($data->pagename)
	{
		//Get static page data
		$data->page = $data->pages[$data->pagename];

		//Get dynamic page data if controller exists
		$controller = PATH_VIEWS . 'pages' . DS . $data->pagename . DS . $data->pagename . EXT_PHP;
		if(file_exists($controller))
		{
			include_once $controller;
		}
	}

	//Determine page template
	if(!$data->template)
	{
		$data->template = 'pages' . DS . $data->pagename . DS . $data->pagename . EXT_PHTML;
	}

	//Render page contents
	if(!($data->content))
	{
		if(file_exists(PATH_VIEWS . $data->template))
		{
			$data->content = render($data->template, $data);
		}
		else
		{
			header(HTTP_HEADER_404_NOT_FOUND);
			$data->page['title'] = $data->site->title;
			$data->warnings[] = array(
				'type' => 'error'
				, 'message' => 'Page Not Found!'
				, 'case' => MB_CASE_UPPER
			);
		}
	}

	//Render warnings
	if(count($data->warnings) > 0)
	{
		$data->warnings = render('warnings' . DS . 'warning-list' . EXT_PHTML, $data);
	}
	else
	{
		$data->warnings = false;
	}

	//Render page data to layout
	echo render('layouts' . DS . $data->layout . EXT_PHTML, $data);
}
?>