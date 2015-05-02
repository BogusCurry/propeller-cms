<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            Application.class.php
 * @version         1
 * @package         Dawn
 * @author          Patrick Bélanger (patrick.belanger <dot>   <dot> com)
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

class Applications {

    protected $applicationName;
    protected $applicationsInstalledName;

    public function createApplicationFromTemplate($name) {

    }

    /**
     * getApplicationsInstalled
     * @return array
     */

    public function getApplicationsInstalled() {
        $this->applicationsInstalledName = array_diff(scandir(APPS_DIR, SCANDIR_SORT_ASCENDING),array('.','..'));
        foreach($this->applicationsInstalledName as $key => $value) {
            if (!is_dir(APPS_DIR . $value . DIRECTORY_SEPARATOR)) {
                unset($this->applicationsInstalledName[$key]);
            }
        }
        sort($this->applicationsInstalledName);
        return $this->applicationsInstalledName;
    }

    /**
     * isApplicationInstalled
     *
     * @param null $applicationName
     * @return bool
     */

    public function isApplicationInstalled($applicationName = null)
    {
        if ($this->applicationsInstalledName == 0) {
            $this->getApplicationsInstalled();
        }
        if ($this->applicationsInstalledName > 0) {
            foreach ($this->applicationsInstalledName as $key => $value) {
                if (ucfirst($value) == $applicationName) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }

}