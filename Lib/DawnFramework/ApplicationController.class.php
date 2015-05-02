<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            ApplicationController.class.php
 * @version         1
 * @package         Dawn
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

namespace DawnFramework;

use \DawnFramework\Applications;
use \DawnFramework\HttpRequest;
use \DawnFramework\HttpResponse;
use \DawnFramework\Sanitize;

abstract class ApplicationController {

    protected $application;
    protected $applicationName;
    protected $environment;
    protected $httpRequest;
    protected $httpResponse;
    protected $systemLogger;

    public function __construct() {
        // Load required objects
        $this->application = new Applications;
        $this->framework = new Framework;
        $this->httpRequest = new HttpRequest;
        $this->httpResponse = new HttpResponse;
        $this->sanitize = new Sanitize;
        $this->applicationName = null;
    }

    /******************************************************************************************************************
     * APPLICATION NAME (GETTER/SETTER)
     *****************************************************************************************************************/

    /**
     * getApplicationName
     *
     * Return application name
     *
     * @return string
     */

    public function getApplicationName() {
        return $this->applicationName;
    }

    /**
     * setApplicationName
     *
     * Set internal application name
     *
     * @param $applicationName
     */

    public function setApplicationName($applicationName) {
        if (is_string($applicationName)) {
            $this->applicationName = $applicationName;
        }
    }

    /******************************************************************************************************************
     * HTTP REQUEST / RESPONSE
     *****************************************************************************************************************/

    /**
     * httpRequest
     *
     * Return httpRequest object
     *
     * @return HttpRequest
     */

    public function httpRequest() {
        return $this->httpRequest;
    }

    /**
     * httpResponse
     *
     * Return httpResponse object
     *
     * @return HttpResponse
     */

    public function httpResponse() {
        return $this->httpResponse;
    }

    /******************************************************************************************************************
     * ABSTRACT FUNCTIONS (APPLICATION CONTROLLER)
     *****************************************************************************************************************/

    /**
     * doGet
     *
     * Abstract function required by application controller. Process GET request.
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
     */

    abstract public function doGet(HttpRequest $httpRequest, HttpResponse $httpResponse);

    /**
     * doPost
     *
     * Abstract function required by application controller. Process POST request.
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
     */

    abstract public function doPost(HttpRequest $httpRequest, HttpResponse $httpResponse);

    /**
     * execute
     *
     * Abstract function. Define Web application entry point
     *
     * @return mixed
     */

    abstract public function execute();

    /**
     * requestDispatcher
     *
     * Abstract function. Dispatch request (based on request method).
     *
     * @param HttpRequest $httpRequest
     * @param HttpResponse $httpResponse
     * @return mixed
     */

    abstract public function requestDispatcher(HttpRequest $httpRequest, HttpResponse $httpResponse);

}