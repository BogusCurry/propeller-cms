<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            StaticView.class.php
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

define("ERR_STATICVIEW_DOESNT_EXIST", "Static content specified doesn't exist (specified file : (%FILENAME%)).");
define("ERR_STATICVIEW_MUST_BE_IN_STATIC_DIR", "Static content must be in Static directory.");
define("STATIC_DIRECTORY_NAME","Static");

class StaticView {

    /**
     * forward
     *
     * Includes and evaluates the specified static view (php file).
     *
     * @param $filename
     */

    public function forward($filename) {
        if (file_exists($filename)) {
            if (strpos($filename,STATIC_DIRECTORY_NAME)) {
                require($filename);
            } else {
                throw new \UnexpectedValueException(ERR_STATICVIEW_MUST_BE_IN_STATIC_DIR);
            }
        } else {
            $errorMsg = str_replace('(%FILENAME%)',$filename, ERR_STATICVIEW_DOESNT_EXIST);
            throw new \RuntimeException($errorMsg);
        }
    }

} 