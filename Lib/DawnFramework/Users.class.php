<?php

namespace DawnFramework;

/**
 * Dawn
 * MVC PHP Framework (5.4+)
 *
 * @description
 * @file            Users.class.php
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


define("ERR_PASSWORD_HASH_VENDOR_REQUIRED", "Password hash function required. Consider updating PHP version up to 5.5.");
define("PASSWORD_COMPAT_VENDOR_DIR", dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Vendor' . DIRECTORY_SEPARATOR . 'password_compat-master' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR);
define("PASSWORD_COMPAT_VENDOR_FILE", 'password.php');
define("PASSWORD_COMPAT_VENDOR_NOT_REQUIRED_VERSION", '5.5');

/**
 * Class Users
 *
 * Providing basic users functions
 *
 * @package DawnFramework
 */

abstract class Users {

    protected $password;
    protected $passwordCompatLibraryUse;

    public function __construct() {
        /**
         * If PHP version is below 5.5, we need to use a vendor library (which is not included in
         * to hash user password (https://github.com/ircmaxell/password_compat)).
         */
        if ($this->isVendorPasswordHashRequired()) {
            $this->passwordCompatLibraryUse = true;
        } else {
            $this->passwordCompatLibraryUse = false;
        }

    }

    private function isVendorPasswordHashRequired()
    {
        if (version_compare(phpversion(), PASSWORD_HASH_VENDOR_NOT_REQUIRED_VERSION, '<')) {
            if (file_exists(PASSWORD_COMPAT_VENDOR_DIR . PASSWORD_COMPAT_VENDOR_FILE)) {
                require(PASSWORD_COMPAT_VENDOR_DIR . PASSWORD_COMPAT_VENDOR_FILE);
            } else {
                throw new \RuntimeException();
            }
            if (\PasswordCompat\binary\check()) {
                return true;
            } else {
              throw new \RuntimeException();
            }
        } else {
            // Current PHP version include password hash functions
            return false;
        }
    }

    /******************************************************************************************************************
     * Password functions
     *****************************************************************************************************************/

    public function createPassword($password)
    {
        if (function_exists('password_hash')) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            throw new \RuntimeException();
        }
    }

    public function verifyPassword($providedPassword,$storedPassword) {
        if (password_verify($providedPassword,$storedPassword)) {
            return true;
        } else {
            return false;
        }
    }

    /******************************************************************************************************************
     * Users functions
     *****************************************************************************************************************/

    abstract public function addUser();

    abstract public function removeUser();

    abstract public function updateUser();

} 