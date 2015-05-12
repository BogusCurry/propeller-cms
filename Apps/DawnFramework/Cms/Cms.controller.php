<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description
 * @file            Cms.controller.php
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

use \DawnFramework;
use \DawnFramework\HttpRequest;
use \DawnFramework\HttpResponse;
use \Apps\DawnFramework\Cms\Lib;

define("CMS_DIR", APPS_DIR . 'Cms' . DIRECTORY_SEPARATOR);
define("CMS_STATIC_DIR", CMS_DIR . 'Static' . DIRECTORY_SEPARATOR);

class Cms extends \DawnFramework\ApplicationController {

    const CMS_CONFIG_FILENAME       = 'Cms.Config.(%TYPE%).php';
    const CMS_CONFIG_LOCAL          = 'local';
    const CMS_CONFIG_REMOTE         = 'remote';

    private static $daoFactory;
    private static $cmsConfiguration;

    protected $route;
    protected $theme;
    protected $systemLogger;
    protected $view;

    public function __construct() {
        parent::__construct();
        $this->setApplicationName("Propeller (CMS)");
        $this->systemLogger = new DawnFramework\SystemLogger($this->getApplicationName(), LOG_PID, LOG_USER);
        $this->routeDispatcher = new Lib\RouteDispatcher();
        self::$cmsConfiguration = new DawnFramework\Configuration($this->getCmsConfigurationFilename());
        self::$daoFactory = new Lib\DaoFactory(self::$cmsConfiguration);
    }

    public function __destroy()
    {
        $this->systemLogger->systemLog(LOG_INFO,'All done');
        $this->systemLogger->closeLog();
    }

    public static function getCmsConfiguration() {
        return self::$cmsConfiguration;
    }

    /**
     * getCmsConfigurationFilename
     *
     * Get Cms configuration filename based on detected environment (local or remote)
     *
     * @return string
     */

    public static function getCmsConfigurationFilename() {
        if (self::isLocal()) {
            $mode = ucfirst(self::CMS_CONFIG_LOCAL);
        } else {
            $mode = ucfirst(self::CMS_CONFIG_REMOTE);
        }
        return CONFIG_DIR . str_replace('(%TYPE%)', $mode, self::CMS_CONFIG_FILENAME);
    }

    /**
     * getDaoFactory()
     *
     * Return Dao Factory object
     *
     * @return Lib\DaoFactory
     */

    public static function getDaoFactory() {
        return self::$daoFactory;
    }

    /**
     * execute
     *
     * Web application entry point
     *
     * @return null
     */

    public function execute() {
        $this->requestDispatcher($this->httpRequest(),$this->httpResponse());
    }

    /**
     * requestDispatcher
     *
     * Route request based on specified method
     *
     * @return null
     */

    public function requestDispatcher(HttpRequest $httpRequest, HttpResponse $httpResponse) {
        switch($httpRequest->getMethod()) {
            case "GET":
                $this->doGet($httpRequest,$httpResponse);
                break;
            case "POST":
                $this->doPost($httpRequest,$httpResponse);
                break;
        }
        $this->routeDispatcher->dispatch($httpRequest, $httpResponse);
    }

    /**
     * doGet
     *
     * Process GET request
     *
     * @return null
     */

    public function doGet(HttpRequest $httpRequest, HttpResponse $httpResponse) {
        $this->sanitize->sanitizeVarUrlEncodeString($httpRequest->getParams());
    }

    /**
     * doPost
     *
     * Process POST request
     *
     * @return null
     */

    public function doPost(HttpRequest $httpRequest, HttpResponse $httpResponse) {
        $this->sanitize->sanitizeVarUrlEncodeString($httpRequest->postParams());
    }

} 