<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description
 * @file            Propeller.class.php
 * @version         1
 * @package         Lib
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

namespace Apps\DawnFramework\Cms\Lib;

define("THEME_DIR", CMS_DIR . 'Static' . DIRECTORY_SEPARATOR . 'Themes' . DIRECTORY_SEPARATOR);
define("THEME_EXTENSION", '.php');

class Themes extends \DawnFramework\StaticView {

    private $theme;
    private $themeComponents = array(
        'header',
        'body',
        'footer',
    );

    /**
     * isThemeExists
     *
     * Determine if specified theme directory exists (or not)
     *
     * @param $name
     * @return bool
     */

    private function isThemeExists($name) {
        if (is_dir(THEME_DIR . ucfirst($name))) {
            return true;
        } else {
            return false;
        }
    }

    public function __construct($name) {
        $this->setTheme($name);
    }

    public function setTheme($name) {
        if ($this->isThemeExists($name)) {
            $this->theme = ucfirst($name);
        }
    }

    public function getTheme() {
        return isset($this->theme) ? $this->theme : null;
    }

    public function setThemeComponents($filename) {
        $themeComponents =  $this->getThemeDir() .
                            $this->getTheme() . '.' .
                            strtolower($filename) . THEME_EXTENSION;
        if (file_exists($themeComponents)) {
            $this->themeComponents[] =  $themeComponents;
            return true;
        } else {
            return false;
        }
    }

    public function getThemeComponents() {
        return isset($this->themeComponents) ? $this->themeComponents : null;
    }

    public function getThemeDir() {
        return THEME_DIR . $this->getTheme() . DIRECTORY_SEPARATOR;
    }

    public function renderThemeComponents() {
        foreach($this->getThemeComponents() as $key => $value) {
            $this->forward($value);
        }
    }

} 