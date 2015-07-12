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
 * @date 30-05-2015
 * @time 14:32
 */
//CORE CONSTANTS
define('DS', DIRECTORY_SEPARATOR);
define('QS', '?');
define('DOT', '.');
define('NL', "\n");
define('SP', ' ');
define('CLN', ':');

//FILE TYPES
define('TYPE_TXT', 'txt');
define('TYPE_PHP', 'php');
define('TYPE_HTML', 'html');
define('TYPE_PHTML', 'phtml');
define('TYPE_INI', 'ini');
define('TYPE_CSV', 'csv');

//FILE EXTENSIONS
define('EXT_TXT', DOT . TYPE_TXT);
define('EXT_PHP', DOT . TYPE_PHP);
define('EXT_HTML', DOT . TYPE_HTML);
define('EXT_PHTML', DOT . TYPE_PHTML);
define('EXT_INI', DOT . TYPE_INI);
define('EXT_CSV', DOT . TYPE_CSV);

//PATHS
define('PATH_SITE', 'site' . DS);
define('PATH_DATA', 'data' . DS);
define('PATH_VIEWS', PATH_SITE . 'views' . DS);
define('PATH_PAGES', PATH_VIEWS . 'pages' . DS);
define('PATH_UTILS', PATH_VIEWS . 'utils' . DS);
define('PATH_SERVICES', PATH_SITE . 'services' . DS);

//HTTP STATUS HEADERS
define('HTTP_VERSION', 'HTTP/1.0');
define('HTTP_HEADER_201_CREATED', HTTP_VERSION . SP . '201 Created');
define('HTTP_HEADER_404_NOT_FOUND', HTTP_VERSION . SP . '404 Not Found');
define('HTTP_HEADER_412_PRECONDITION_FAILED', HTTP_VERSION . SP . '412 Precondition Failed');
define('HTTP_HEADER_500_INTERNAL_SERVER_ERROR', HTTP_VERSION . SP . '500 Internal Server Error');
?>