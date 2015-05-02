<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description     HttpRequest class. Handle HTTP request.
 * @file            HttpRequest.php
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

class HttpRequest {

    /******************************************************************************************************************
     * COOKIES
     *****************************************************************************************************************/

    /**
     * cookieExist
     *
     * Return if key exists in $_GET or not
     *
     * @param $key
     * @return bool
     */

    public function cookieExist($key) {
        return isset($_COOKIE[$key]);
    }

    /**
     * cookieParam
     *
     * Return value from $_COOKIE
     *
     * @param $key
     * @return null
     */

    public function cookieParam($key) {
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
    }

    /******************************************************************************************************************
     * FORM
     *****************************************************************************************************************/

    public function getScriptFilename() {
        return basename($_SERVER['SCRIPT_NAME']);
    }

    /******************************************************************************************************************
     * $_GET
     *****************************************************************************************************************/

    /**
     * getExist
     *
     * Return if key exists in $_GET or not
     *
     * @param $key
     * @return bool
     */

    public function getExist($key) {
        return isset($_GET[$key]);
    }

    /**
     * getParam
     *
     * Return value from $_GET
     *
     * @param $key
     * @return null
     */

    public function getParam($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    /**
     * getParams
     *
     * Return $_GET array
     *
     * @return null
     */

    public function getParams() {
        return isset($_GET) ? $_GET : null;
    }

    /**
     * setGetParam
     *
     * Set key and value into $_GET
     *
     * @param $key
     * @param $value
     * @return null
     */

    public function setGetParam($key,$value) {
        return isset($value) ? $_GET[$key] = $value : null;
    }

    /******************************************************************************************************************
     * $_POST
     *****************************************************************************************************************/

    /**
     * postExist
     *
     * Return if key exists in $_POST or not
     *
     * @param $key
     * @return bool
     */

    public function postExist($key) {
        return isset($_POST[$key]);
    }

    /**
     * postParam
     *
     * Return value from $_POST
     *
     * @param $key
     * @return null
     */

    public function postParam($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    /**
     * postParams
     *
     * Return $_POST array
     *
     * @return null
     */

    public function postParams() {
        return isset($_POST) ? $_POST : null;
    }

    /**
     * setPostParam
     *
     * Set key and value into $_POST
     *
     * @param $key
     * @param $value
     * @return null
     */

    public function setPostParam($key,$value) {
        return isset($value) ? $_POST[$key] = $value : null;
    }

    /**
     * setPostParams
     *
     * Set array keys and values into $_POST
     *
     * @param $array
     */

    public function setPostParams($array) {
        if (isset($array)) {
            foreach ($array as $key => $value) {
                $_POST[$key] = $value;
            }
        }
    }

    /******************************************************************************************************************
     * $_SERVER
     *****************************************************************************************************************/

    /**
     * getMethod
     *
     * Return request method (GET, HEAD, POST, PUT)
     *
     * @return mixed
     */

    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

    /******************************************************************************************************************
     * MISCELLANEOUS
     *****************************************************************************************************************/

}