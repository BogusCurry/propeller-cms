<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description
 * @file            DaoFactory.class.php
 * @version         1
 * @package         Lib
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

namespace Apps\DawnFramework\Cms\Lib;

use DawnFramework\Configuration;

class DaoFactory extends \PDO {

    const MYSQL_DNS         = 'mysql:host=(host);dbname=(database);charset=UTF8';
    const POSTGRES_DNS      = 'pgsql:host=(host);port=(port);dbname=(database);user=(user);password=(password)'; /* Not supported yet - Will be in the future */

    private $databaseConfig;
    private $databaseDns;
    private $databaseOptions;
    private $databaseQueryString;

    /**
     * __construct
     * @param Configuration $configuration
     */

    public function __construct(Configuration $configuration) {
        $this->databaseConfig = $configuration->getConfigurationValuesFromRootKey('database');
        parent::__construct($this->getDatabaseDns(), $this->getDatabaseConfig('username'), $this->getDatabaseConfig('password'), $this->databaseOptions);
    }

    /**
     * @return Configuration
     */

    public function getDatabaseConfig($value)
    {
        return $this->databaseConfig[$value];
    }

    /**
     * getDatabaseDns
     */

    public function getDatabaseDns()
    {
        switch ($this->getDatabaseConfig('type')) {
            case 'mysql':
                $this->databaseDns = self::MYSQL_DNS;
                $this->databaseDns = str_replace('(host)', $this->databaseConfig['host'], $this->databaseDns);
                $this->databaseDns = str_replace('(database)', $this->databaseConfig['database'], $this->databaseDns);
                $this->databaseOptions = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',\PDO::ATTR_PERSISTENT => true);
                break;
            case 'pgsql';
                // Not implemented yet
                $this->databaseDns = null;
                $this->databaseOptions = null;
                break;
        }
        return $this->databaseDns;
    }

    /**
     * setQueryString
     * @param $query
     */

    public function setQueryString($query) {
        $this->databaseQueryString = $query;
    }

    /**
     * getQueryString()
     * @return mixed
     */

    public function getQueryString()
    {
        return $this->databaseQueryString;
    }

} 