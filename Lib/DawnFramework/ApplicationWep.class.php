<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            ApplicationWep.class.php    (Web Entry Point)
 * @version         2
 * @package         Dawn
 * @author          Patrick Bélanger (patrick.belanger <dot> gmail  <dot> com)
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

namespace DawnFramework;

use \DawnFramework\Applications;
use \DawnFramework\ApplicationController;
use \DawnFramework\Configuration;

class ApplicationWep extends ApplicationController {

    const APPLICATION_WEP_CONFIG_FILENAME   = 'Wep.Config.(%TYPE%).php';
    const APPLICATION_WEP_CONFIG_LOCAL      = 'local';
    const APPLICATION_WEP_CONFIG_REMOTE     = 'remote';

    protected $wepApplication;
    protected $wepConfiguration;

    public function __construct() {
        parent::__construct();
        $this->wepConfiguration = new Configuration($this->getWepConfigurationFilename());
        $this->wepConfiguration->setConfigurationKey('wep');
    }

    /******************************************************************************************************************
     * CONFIGURATION
     *****************************************************************************************************************/

    /**
     * isLocal
     *
     * Return true (or false) if Application Web Entry Point is run in local mode (or in remote)
     *
     * @return bool
     */

    private function isLocal() {
        if (($_SERVER['SERVER_NAME'] == 'localhost') || ($_SERVER['SERVER_ADDR'] == '127.0.0.1')) {
            return true;
        } else {
            return false;
        }
    }

    private function getWepConfigurationValues() {
        return $this->wepConfiguration->getConfigurationValuesKeyBased();
    }

    /**
     * getWepConfigurationFilename
     *
     * Get Wep configuration filename based on detected environment (local or remote)
     *
     * @return string
     */

    private function getWepConfigurationFilename() {
        if ($this->isLocal()) {
            $mode = ucfirst(self::APPLICATION_WEP_CONFIG_LOCAL);
        } else {
            $mode = ucfirst(self::APPLICATION_WEP_CONFIG_REMOTE);
        }
        return CONFIG_DIR . str_replace('(%TYPE%)', $mode, self::APPLICATION_WEP_CONFIG_FILENAME);
    }


    /******************************************************************************************************************
     * APPLICATION WEB ENTRY
     *****************************************************************************************************************/

    private function executeApplication($name)
    {
        if (isset($name)) {
            $application = '\\Apps\\DawnFramework\\' . $name;
            return $this->wepApplication = new $application;

        } else {
            return false;
        }
    }


    private function executeApplicationWep(HttpRequest $httpRequest, HttpResponse $httpResponse)
    {
        $wepConfig = $this->getWepConfigurationValues();
        if ($httpRequest->getExist('app')) {
            /**
             * If application is defined in "app" (get) parameter, Application Web Entry Point will launch the
             * requested application.
             */
            $httpRequest->setGetParam('app',$this->sanitize->sanitizeVarUrlEncodeString($httpRequest->getParam('app'),FILTER_SANITIZE_SPECIAL_CHARS));
            $this->executeApplication($httpRequest->getParam('app'));
            $this->wepApplication->execute();
        } else {
            /**
             * In the other hand, if no application is defined, we need to determine if a default application is
             * defined in configuration file. If no default application is defined, we'll launch the Application Web Entry Point
             * interface (aka developer bootstrap interface).
             */
            if (isset($wepConfig['application']['default']))  {
                $httpRequest->setGetParam('app',$this->sanitize->sanitizeVarUrlEncodeString($wepConfig['application']['default'],FILTER_SANITIZE_SPECIAL_CHARS));
                $this->executeApplication($httpRequest->getParam('app'));
                $this->wepApplication->execute();
            } else {
                // TODO : If no application defined, Application Web Entry Point must be launched (if environment is local mode)
                // Otherwise, if defined, default application will be executed (unless stated)
            }
        }
    }

    /******************************************************************************************************************
     * APPLICATION CONTROLLER (APPLICATION WEB ENTRY)
     *****************************************************************************************************************/

    /**
     * doGet
     *
     * Process GET request.
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
     */

    public function doGet(HttpRequest $httpRequest, HttpResponse $httpResponse) {
        $this->executeApplicationWep($httpRequest, $httpResponse);
    }

    /**
     * doPost
     *
     * Process POST request.
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
     */

    public function doPost(HttpRequest $httpRequest, HttpResponse $httpResponse) {
        $this->executeApplicationWep($httpRequest, $httpResponse);
    }

    /**
     * execute
     *
     * Define application Web Entry Point (WEP)
     *
     * @return mixed
     */

    public function execute() {
        $this->requestDispatcher($this->httpRequest(),$this->httpResponse());
    }

    /**
     * requestDispatcher
     *
     * Dispatch request (based on request method).
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
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
    }

} 