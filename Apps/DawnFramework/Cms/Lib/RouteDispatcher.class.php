<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description
 * @file            RouteDispatcher.class.php
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

use Apps\DawnFramework\Cms;
use Apps\DawnFramework\Cms\Lib;
use DawnFramework\HttpRequest;
use DawnFramework\HttpResponse;

define("ERROR_DIR",         'Errors' . DIRECTORY_SEPARATOR);

class RouteDispatcher extends Router {

    /* Default routes */
    const ROUTE_ADMIN       = 'administer';
    const ROUTE_ARTICLES    = 'articles';
    const ROUTE_DELETE      = 'delete';
    const ROUTE_GET         = 'get';
    const ROUTE_MEDIA       = 'media';
    const ROUTE_MODULE      = 'module';
    const ROUTE_PAGES       = 'pages';
    const ROUTE_POST        = 'post';
    const ROUTE_PUT         = 'put';
    const ROUTE_RESOURCES   = 'resources';
    const ROUTE_DEFAULT     = self::ROUTE_PAGES;    // Default route if not specified
    const ROUTE_DISPATCHER  = 'exec';

    private $route;
    private $dispatcher;
    private $pages;

    /* Routes : Default routes are mentionned. Developper can add more actions (by using setRoute method)*/
    private $routeOptions = array(
        self::ROUTE_ADMIN,
        self::ROUTE_ARTICLES,
        self::ROUTE_DELETE,
        self::ROUTE_GET,
        self::ROUTE_MEDIA,
        self::ROUTE_MODULE,
        self::ROUTE_PAGES,
        self::ROUTE_POST,
        self::ROUTE_PUT,
        self::ROUTE_RESOURCES,
    );

    /**
     * __construct()
     *
     */

    public function __construct() {
        parent::__construct();
    }

    /**
     * dispatch()
     *
     * Dispatch, process request and return view
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     */

    public function dispatch(HttpRequest $httpRequest, HttpResponse $httpResponse) {
        $this->prepareDispatchMethodBased($httpRequest);
        switch($httpRequest->getParam(self::ROUTE_DISPATCHER)) {
            case self::ROUTE_PAGES:
                $this->pages = new PagesDaoImplementation(Cms::getDaoFactory());
                $this->dispatcher = new View(Cms::getCmsConfiguration());
                break;
            case $this->getSpecifiedRoute($httpRequest):

                break;
            default:
                $httpResponse->forward(CMS_STATIC_DIR . ERROR_DIR . '404.php');
                $httpResponse->headerSend("HTTP/1.0 404 Not Found");
                break;
        }
    }

    /**
     * getRouteOptions()
     *
     * @return array
     */

    public function getRouteOptions()
    {
        return $this->routeOptions;
    }

    /**
     * getSpecifiedRoute
     *
     * @param HttpRequest $httpRequest
     * @return null
     */

    public function getSpecifiedRoute(HttpRequest $httpRequest) {
        foreach($this->routeOptions as $key) {
            if ($httpRequest->getExist(self::ROUTE_DISPATCHER)) {
                if ($httpRequest->getParam(self::ROUTE_DISPATCHER) == $key) {
                    return $key;
                    break;
                }
            }
        }
        return null;
    }

    /**
     * setNewRoute()
     *
     * @param $value
     */

    public function setNewRoute($value) {
        $this->routeOptions[] = urlencode(strtolower($value));
    }

    /**
     * prepareDispatchMethodBased()
     *
     * @param HttpRequest $httpRequest
     */

    private function prepareDispatchMethodBased(HttpRequest $httpRequest) {
        switch($this->getRouteMethod()) {
            case (self::REWRITE_RULE_METHOD_GET):
                // "get" parameter mode : If exec parameter is not specified, we'll use the default route. Otherwise,
                // we'll use specified value.
                if (!$httpRequest->getExist('exec')) {
                    $httpRequest->setGetParam('exec',self::ROUTE_DEFAULT);
                }
                break;
            case (self::REWRITE_RULE_METHOD_HTACCESS):
                // "htaccess" mode (semantic (clean) url) : if we are not able to route specified path, we'll use
                // default route. Value will be injected into exec get parameter.
                $this->route = $this->getRouteArray();
                if (sizeof($this->getRouteArray())) {
                    $httpRequest->setGetParam('exec', $this->getRoute(0));
                } else{
                    $httpRequest->setGetParam('exec',self::ROUTE_DEFAULT);
                }
                break;
        };
    }

} 