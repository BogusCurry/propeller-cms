<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description
 * @file            PagesDaoImplementation.class.php
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

class PagesDaoImplementation implements PagesDao {

    private $daoFactory = null;
    private $daoDatabaseHandle;
    private $daoQueryResults;

    public function __construct(DaoFactory $daoFactory) {
        $this->daoFactory = $daoFactory;
    }

    public function getPageId($id) {
        $this->daoFactory->setQueryString('SELECT * FROM pages WHERE id=:id');

        //$this->daoDatabaseHandle = $this->daoFactory->prepare($this->daoFactory->getQueryString());
        $this->daoDatabaseHandle = $this->daoFactory->prepare($this->daoFactory->getQueryString());
        $this->daoDatabaseHandle->bindValue(':id',$id,\PDO::PARAM_STR);
        $this->daoDatabaseHandle->execute();
        return $this->daoQueryResults = $this->daoDatabaseHandle->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPageName($name = 'home') {

    }
} 