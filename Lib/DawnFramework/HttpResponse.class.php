<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description     HttpResponse class. Handle HTTP response (header, cookie).
 * @file            HttpResponse.php
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

class HttpResponse extends \DawnFramework\StaticView {

    /******************************************************************************************************************
     * COOKIES
     *****************************************************************************************************************/

    public function addCookie($cookie) {
        setcookie(
            isset($cookie['name']) ? $cookie['name'] : $cookie = '',
            isset($cookie['value']) ? $cookie['value'] : $cookie = '',
            isset($cookie['expire']) ? $cookie['expire'] : $cookie = 0,
            isset($cookie['path']) ? $cookie['path'] : null,
            isset($cookie['domain']) ? $cookie['domain'] : null,
            isset($cookie['secure']) ? $cookie['secure'] : false,
            isset($cookie['httpOnly']) ? $cookie['httpOnly'] : true
        );
    }

    /******************************************************************************************************************
     * DECODE / ENCODE
     *****************************************************************************************************************/

    public function decodeUrl($url) {
        return urldecode($url);
    }

    public function encodeUrl($url) {
        return urlencode($url);
    }

    /******************************************************************************************************************
     * HEADER
     *****************************************************************************************************************/

    public function headerSend($raw) {
        if (!headers_sent()) {
            header($raw);
        }
        exit;
    }

    public function headerSetCharacterEncoding($charset = 'utf-8') {
        header('Content-Type: text/html; charset=' . $charset);
        exit;
    }

    public function headersList() {
        return headers_list();
    }

    /******************************************************************************************************************
     * HEADER (REDIRECT/FORWARD)
     *****************************************************************************************************************/

    public function redirect($location) {
        if (!headers_sent()) {
            header('location' . $location);
        }
        exit;
    }

}