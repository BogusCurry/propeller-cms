<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description     Application Web Entry Point
 * @file            index.php
 * @version         1
 * @package         Cms
 * @author          Patrick Bélanger (patrick.belanger <dot> gmail <dot> com)
 * @licence         Apache 2.0  http://www.apache.org/licenses/LICENSE-2.0
 *
 * Copyright © 2015, Patrick Bélanger and contributors. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Apps\DawnFramework;

define("FRAMEWORK",     'DawnFramework');
define("APPLICATION",   'Propeller');
define("PHP_VERSION_MIN_REQUIRED", '5.4.3');
define("BASE_DIR",      dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("APPS_DIR",      BASE_DIR . 'Apps' . DIRECTORY_SEPARATOR . FRAMEWORK . DIRECTORY_SEPARATOR);
define("CONFIG_DIR",    BASE_DIR . 'Config' . DIRECTORY_SEPARATOR);
define("LIB_DIR",       BASE_DIR . 'Lib' . DIRECTORY_SEPARATOR);

define("ERR_PHP_VERSION_DOES_NOT_MET_REQUIREMENT", 'PHP version ' . PHP_VERSION_MIN_REQUIRED . ' is required in order to run ' . APPLICATION);

/**
 * Autoload required classes at run-time
 */

spl_autoload_register(function ($class) {
    if (strstr($class,'Apps\\')) {
        /**
         * Directory scan in order to find automatically the specified application controller.
         * Otherwise, classes related to specified application will be loaded automatically.
         */
        $filename = str_replace('Apps\\', null, $class);
        $register = str_replace(FRAMEWORK . '\\', null, $filename);
        $filename = APPS_DIR . $register . DIRECTORY_SEPARATOR . $register . '.controller.php';
        if (!file_exists($filename)) {
            $filename = APPS_DIR . $register . '.class.php';
        }
    } else  {
        $filename = LIB_DIR . $class . '.class.php';
    }
    require($filename);
});

/**
 * Make sure we met minimum requirement before executing Propeller
 */

if (version_compare(phpversion(), PHP_VERSION_MIN_REQUIRED, '>=')) {
    $wep = new \DawnFramework\ApplicationWep;
    $wep->execute();
} else {
    throw new \RuntimeException(ERR_PHP_VERSION_DOES_NOT_MET_REQUIREMENT);
}
