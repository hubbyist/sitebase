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
 * __constants.php__
 *
 * @author Mehmet Durgel <md@legrud.net>
 * @date 28-11-2015
 * @time 15:32
 */
//CORE CONSTANTS
define('DS', DIRECTORY_SEPARATOR);
define('QS', '?');
define('NL', "\n");
define('US', '_');
define('HY', '-');
define('DOT', '.');
define('CMM', ',');
define('SPC', ' ');
define('CLN', ':');

//COMMON PATHS
define('PATH_SITE', 'site' . DS);

//FILE TYPES
define('TYPE_TXT', 'txt');
define('TYPE_PHP', 'php');
define('TYPE_HTML', 'html');
define('TYPE_PHTML', 'phtml');
define('TYPE_INI', 'ini');
define('TYPE_JS', 'js');
define('TYPE_CSS', 'css');

//FILE EXTENSIONS
define('EXT_TXT', DOT . TYPE_TXT);
define('EXT_PHP', DOT . TYPE_PHP);
define('EXT_HTML', DOT . TYPE_HTML);
define('EXT_PHTML', DOT . TYPE_PHTML);
define('EXT_INI', DOT . TYPE_INI);
define('EXT_JS', DOT . TYPE_JS);
define('EXT_CSS', DOT . TYPE_CSS);

//HTTP METHODS
define('HTTP_METHOD_HEAD', 'HEAD');
define('HTTP_METHOD_OPTIONS', 'OPTIONS');
define('HTTP_METHOD_GET', 'GET');
define('HTTP_METHOD_PUT', 'PUT');
define('HTTP_METHOD_POST', 'POST');
define('HTTP_METHOD_PATCH', 'PATCH');
define('HTTP_METHOD_DELETE', 'DELETE');

//HTTP STATUS HEADERS
define('HTTP_VERSION', 'HTTP/1.0');
define('HTTP_HEADER_200_OK', HTTP_VERSION . SPC . '200 OK');
define('HTTP_HEADER_201_CREATED', HTTP_VERSION . SPC . '201 Created');
define('HTTP_HEADER_404_NOT_FOUND', HTTP_VERSION . SPC . '404 Not Found');
define('HTTP_HEADER_405_METHOD_NOT_ALLOWED', HTTP_VERSION . SPC . '405 Method Not Allowed');
define('HTTP_HEADER_412_PRECONDITION_FAILED', HTTP_VERSION . SPC . '412 Precondition Failed');
define('HTTP_HEADER_500_INTERNAL_SERVER_ERROR', HTTP_VERSION . SPC . '500 Internal Server Error');
?>