<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            Sanitize.class.php
 * @version         1
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

class Sanitize {

    /**
     * sanitizeInput
     *
     * Gets a specific external variable by name and optionally filters it
     *
     * @param int $type     INPUT_GET
     *                      INPUT_POST
     *                      INPUT_COOKIE
     *                      INPUT_SERVER
     *                      INPUT_ENV
     * @param $var          Name of a variable to get.
     * @param int $filter   The ID of the filter to apply (default is : FILTER_SANITIZE_FULL_SPECIAL_CHARS)
     * @return mixed
     */

    public function sanitizeInput($type = INPUT_GET, $var, $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS) {
        return filter_input($type, $var, $filter);
    }


    /**
     * sanitizeInputArray
     *
     * Gets external variables and optionally filters them. Useful for retrieving many values without
     * repetitively calling sanitizeInput.
     *
     * @param int $type     INPUT_GET
     *                      INPUT_POST
     *                      INPUT_COOKIE
     *                      INPUT_SERVER
     *                      INPUT_ENV
     * @param $arrayValuesDefintions    An array defining the arguments
     * @return mixed
     */

    public function sanitizeInputArray($type = INPUT_GET, $arrayValuesDefintions) {
        return filter_input_array($type, $arrayValuesDefintions);
    }

    /**
     * sanitizeVarEmail
     *
     * Remove all characters except letters, digits and !#$%&'*+-/=?^_`{|}~@.[].
     *
     * @param $email
     * @return mixed
     */

    public function sanitizeVarEmail($email) {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * sanitizeVarFloat
     *
     * Remove all characters except digits, +- and optionally .,eE.
     *
     * @param $float
     * @return mixed
     */

    public function sanitizeVarFloat($float) {
        return filter_var($float, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    /**
     * sanitizeVarInteger
     *
     * Remove all characters except digits, plus and minus sign.
     *
     * @param $int
     * @return mixed
     */

    public function sanitizeVarInteger($int) {
        return filter_var($int = FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * sanitizeVarString
     *
     * Strip tags, optionally strip or encode special characters.
     *
     * @param $string
     * @return mixed
     */

    public function sanitizeVarString($string) {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    /**
     * sanitizeVarUrl
     *
     * Remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
     *
     * @param $url
     * @return mixed
     */

    public function sanitizeVarUrl($url) {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * sanitizeVarUrlEncodeString
     *
     * URL-encode string, optionally strip or encode special characters.
     *
     * @param $url
     * @return mixed
     */

    public function sanitizeVarUrlEncodeString($url) {
        return filter_var($url, FILTER_SANITIZE_ENCODED);
    }

} 