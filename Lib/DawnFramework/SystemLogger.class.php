<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            SystemLogger.class.php
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

class SystemLogger {

    protected $systemLogger;

    /**
     * __construct
     *
     * Create system logger object. Open connection to system logger
     *
     * @param string $ident
     * @param int $option
     * @param int $facility
     */

    public function __construct($ident = FRAMEWORK , $option = LOG_PID, $facility = LOG_USER) {
        $this->systemLogger = openlog($ident, $option, $facility);
    }

    /**
     * closeLog
     *
     * Close connection to system logger
     *
     * @return bool
     */

    public function closeLog() {
        return closelog();
    }

    /**
     * systemLog
     *
     *
     * @param int $priority     LOG_EMERG	system is unusable
     *                          LOG_ALERT	action must be taken immediately
     *                          LOG_CRIT	critical conditions
     *                          LOG_ERR	    error conditions
     *                          LOG_WARNING	warning conditions
     *                          LOG_NOTICE	normal, but significant, condition
     *                          LOG_INFO	informational message
     *                          LOG_DEBUG	debug-level message
     * @param $message
     * @return bool
     * @see http://php.net/manual/en/function.syslog.php
     */

    public function systemLog($priority = LOG_INFO, $message) {
        return syslog($priority,$message);
    }
}