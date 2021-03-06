<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description     Router : Url request dispatcher
 * @file            Router.class.php
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


class Router {

    const REWRITE_RULE                  = 'RewriteRule ^ index.php [QSA,L]';    // Case insensitive
    const REWRITE_RULE_METHOD_GET       = 'get';
    const REWRITE_RULE_METHOD_HTACCESS  = 'htaccess';

    private $basePath;
    private $routeMethod = null;
    private $routes = array();
    private $uri;

    /**
     * __construct()
     */

    public function __construct() {
        if ($this->getRouteMethod() == self::REWRITE_RULE_METHOD_HTACCESS) {
            $this->getRouteMethod();
            $this->getCurrentUri();
            $this->getRoutes();
        }
        // TODO * If .htaccess can't be modified on host service provider, Propeller must work by using get parameters.
    }

    /**
     * getCurrentUri()
     *
     * Return current Uri (without
     *
     * @return string
     */

    private function getCurrentUri()
    {
        $this->basePath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basePath));
        print(strstr($this->uri, '?'));
        if (strstr($this->uri, '?')) {
            if (!strstr($this->uri,'=')) {
                $this->uri = substr($this->uri, 0, strpos($$this->uri, '?'));
                $this->uri = '/' . trim($this->uri, '/');
            } else {
                $this->uri = '/';
            }
        }

        return $this->uri;
    }

    /**
     * getRoutes()
     *
     * @return array
     */

    private function getRoutes() {
        $this->routes = explode('/',$this->uri);
        foreach($this->routes as $key => $value) {
            if ($value == '') {
                unset($this->routes[$key]);
            }
        }
        sort($this->routes);
        return $this->routes;
    }

    /**
     * getRoute()
     *
     * Return route based on specified position (ex : /pages/home/ (pages = 0, home = 1)
     *
     * @param int $position
     * @return mixed
     */

    public function getRoute($position = 0) {
        return $this->routes[$position];
    }

    /**
     * getRouteArray()
     *
     * @return array
     */
    public function getRouteArray() {
        return $this->routes;
    }

    /**
     * getRouteMethod
     *
     * Determine how CMS will handle request and route
     *
     * @return string
     */

    public function getRouteMethod() {
        // We do not want to read .htaccess every time we call this method. If we already have the value
        // stored, we'll return back that value. Otherwise, we must determine which method Propeller
        // will use to route request.
        if ($this->routeMethod == null) {
            $this->routeMethod = self::REWRITE_RULE_METHOD_GET;
            $file = file_get_contents(BASE_DIR . '.htaccess');
            $scan = explode(chr(10),$file);
            foreach($scan as $key => $value) {
                $scan[$key] = str_replace(chr(10),'',$value);
                $scan[$key] = str_replace(chr(9),'',$scan[$key]);
                $scan[$key] = str_replace(chr(13),'',$scan[$key]);
                $scan[$key] = trim($scan[$key]);
                if ((strtolower($scan[$key])) == (strtolower(self::REWRITE_RULE))) {
                    $this->routeMethod = self::REWRITE_RULE_METHOD_HTACCESS;
                    break;
                }
            }
        }
        return $this->routeMethod;
    }

} 