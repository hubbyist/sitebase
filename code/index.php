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

//Get Common Constants
include_once 'constants.php';

//Get Common Functions
include_once 'functions.php';

//Register error handler function
set_error_handler('showError');

//Create and initialize common data registry object
$data = new stdClass();
$data->admin = false;
$data->pagename = false;
$data->page = false;
$data->content = false;
$data->layout = 'main';

//Parse site ini file if exists
$site_ini_file = PATH_SITE . 'site' . EXT_INI;
if(file_exists($site_ini_file))
{
	$data->site = parse_ini_file($site_ini_file, true, INI_SCANNER_RAW);
}

//Get pages list
$data->pages = pageslist(PATH_PAGES);

//Determine request path
$path = trim(str_replace(baseURL(), '', baseURI()));
//Determine request type
if(file_exists(PATH_SERVICES . $path . EXT_PHP))
{
	//Set service name
	$data->servicename = $path;
	include_once PATH_SERVICES . $path . EXT_PHP;
}
else
{
	//Set page name
	$target = str_replace(EXT_HTML, '', $path);
	if(!$target)
	{
		$data->pagename = 'index';
	}
	elseif(array_key_exists($target, $data->pages))
	{
		$data->pagename = $target;
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

	//Render page contents
	$template = 'pages' . DS . $data->pagename . DS . $data->pagename . EXT_PHTML;
	if(!($data->content) && file_exists(PATH_VIEWS . $template))
	{
		$data->content = render($template, $data);
	}
	else
	{
		header(HTTP_HEADER_404_NOT_FOUND);
		$data->page['title'] = $data->site['title'];
		$data->content = render('warnings' . DS . 'pagenotfound' . EXT_PHTML, $data);
	}

	//Render page data to layout
	echo render('layouts' . DS . $data->layout . EXT_PHTML, $data);
}
?>