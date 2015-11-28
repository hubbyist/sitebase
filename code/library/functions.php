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
 * @date 28-11-2015
 * @time 15:31
 */

/**
 * convert Array to Object function
 */
function ARRAYtoOBJECT($array){
	$object = new stdClass();
	foreach($array as $key => $value){
		$object->$key = $value;
	}
	return $object;
}

/**
 * Case conversation function with preparation
 */
function convertCase($text, $case, $language = null){
	$preparator = 'convertcase_preparation' . US . $language;
	if(function_exists($preparator))
	{
		$text = $preparator($text);
	}
	return mb_convert_case($text, $case);
}

/**
 * Load Config File
 */
function loadConfig($path, $file, &$data){
	$path = $path . $file . EXT_INI;
	if(file_exists($path))
	{
		$data->{$file} = ARRAYtoOBJECT(parse_ini_file($path, true, INI_SCANNER_RAW));
	}
}
?>