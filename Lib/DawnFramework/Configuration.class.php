<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description     Configuration class. Provide basic function to read configuration file.
 * @file            Configuration.class.php
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

/**
 * CONFIGURATION_DIR
 *
 * Define configuration directory
 */

define("CONFIGURATION_DIR",'Config' . DIRECTORY_SEPARATOR);

define("ERR_CONFIGURATION_FILE_NOT_FOUND",'Specified configuration file not found');
define("ERR_CONFIGURATION_FILE_IS_EMPTY",'Specified configuration file is empty');
define("ERR_CONFIGURATION_MUST_BE_IN_CONFIGURATION_DIR",'Configuration file must be in "' . CONFIGURATION_DIR . '" directory');


class Configuration {

    protected $configurationValues;
    protected $configurationFile;
    protected $configurationKey;

    /**
     * __construct
     *
     * Instantiate Configuration object
     *
     * @param $filename
     */

    public function __construct($filename) {
        $this->setConfigurationFile($filename);
    }

    /**
     * setConfigurationFile
     *
     * Define configuration file and validate if can be used or not.
     *
     * @param $filename
     */

    private function setConfigurationFile($filename) {
        if (file_exists($filename)) {
            if (strstr($filename,CONFIGURATION_DIR)) {
                $this->configurationFile = $filename;
                require($filename);
                if (isset($config)) {
                    if (is_array($config)) {
                        $this->configurationValues = $config;
                    }
                } else {
                    throw new \UnexpectedValueException(ERR_CONFIGURATION_FILE_IS_EMPTY);
                }
            } else {
                throw new \RuntimeException(ERR_CONFIGURATION_MUST_BE_IN_CONFIGURATION_DIR);
            }
        } else {
            throw new \RuntimeException(ERR_CONFIGURATION_FILE_NOT_FOUND);
        }
    }

    /**
     * setConfigurationKey
     *
     * Define configuration key to read in configuration file
     *
     * @param $key
     */

    public function setConfigurationKey($key) {
        $this->configurationKey = $key;
    }

    /**
     * getConfigurationValuesKeyBased()
     *
     * Use key value set in $this->configurationKey and return configuration value based on key provided
     *
     * @return array
     * @return null
     */

    public function getConfigurationValuesKeyBased() {
        return isset($this->configurationValues[$this->configurationKey]) ? $this->configurationValues[$this->configurationKey] : null;
    }

    /**
     * getConfigurationValuesFromRootKey
     *
     * Return configuration keys and values based on root key provided
     *
     * @param $key
     * @return array
     * @return null
     */

    public function getConfigurationValuesFromRootKey($key) {
        return isset($this->configurationValues[$key]) ? $this->configurationValues[$key] : null;
    }

} 