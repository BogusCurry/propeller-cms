<?php

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description     Framework version information class for Dawn Framework
 * @file            Framework.class.php
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

final class Framework {

    /******************************************************************************************************************
     * Constants
     *****************************************************************************************************************/

    /**
     * PRODUCT_NAME
     *
     * Define Dawn Framework as product name
     */
    const   PRODUCT_NAME = 'Dawn Framework';

    /**
     * PRODUCT_VERSION_MAJOR
     *
     * Define Dawn Framework major version number
     */

    const   PRODUCT_VERSION_MAJOR = '1';

    /**
     * PRODUCT_VERSION_MINOR
     *
     * Define Dawn Framework minor version number
     */

    const   PRODUCT_VERSION_MINOR = '0';

    /**
     * PRODUCT_VERSION_BUILD
     *
     * Define Dawn Framework build number
     */

    const   PRODUCT_VERSION_BUILD = '0';

    /**
     * PRODUCT_VERSION_BUILD
     *
     * Define Dawn Framework build date
     */

    const   PRODUCT_VERSION_BUILD_DATE = '22-03-2015';

    /**
     * PRODUCT_VERSION_REVISION
     *
     * Define Dawn Framework revision number (patch)
     */

    const   PRODUCT_VERSION_REVISION = '0';

    /**
     * PRODUCT_VERSION_RELEASE_CODENAME
     *
     * Define Dawn Framework release code name (theme : cities around the world)
     */

    const   PRODUCT_VERSION_RELEASE_CODENAME = 'Adelaide';

    /**
     * PRODUCT_COPYRIGHT_NOTICE
     *
     * Define Dawn Framework copyright notice
     */

    const   PRODUCT_COPYRIGHT   = 'Copyright © 2015, Patrick Bélanger and contributors. All rights reserved';

    /******************************************************************************************************************
     * Static functions
     *****************************************************************************************************************/

    /**
     * getVersion
     *
     * Return current version (long version)
     *
     * @return string
     */

    public static function getVersion() {
        return  self::PRODUCT_VERSION_MAJOR . '.' .
                self::PRODUCT_VERSION_MINOR . ' (build : (' .
                self::PRODUCT_VERSION_BUILD_DATE . ')' .
                self::PRODUCT_VERSION_BUILD . ' - rev. : ' .
                self::PRODUCT_VERSION_REVISION . ')';
    }

    /**
     * getVersionShort
     *
     * Return current version (short version)
     *
     * @return string
     */

    public static function getVersionShort() {
        return  self::PRODUCT_VERSION_MAJOR . '.' .
                self::PRODUCT_VERSION_MINOR . '.' .
                self::PRODUCT_VERSION_BUILD . '.' .
                self::PRODUCT_VERSION_REVISION;
    }

}