<?php

/**
 * Propeller
 * CMS (Content Management System)
 * Using Dawn MVC PHP Framework (5.4+)
 *
 * @description
 * @file            Pages.class.php
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

class Pages {

    private $pageLocale;
    private $pageName;
    private $pageType;
    private $pageInternalSrc;
    private $pageExternalSrc;

    public function setPageLocale($locale) {
        $this->pageLocale = $locale;
    }

    public function getPageLocale() {
        return $this->pageLocale;
    }

    public function setPageName($name) {
        $this->pageName = $name;
    }

    public function getPageName() {
        return $this->pageName;
    }

    public function setPageType($type) {
        $this->pageType = $type;
    }

    public function getPageType() {
        return $this->pageType;
    }

    public function setPageInternalSrc($internalSrc) {
        $this->pageInternalSrc = $internalSrc;
    }

    public function getPageInternalSrc() {
        return $this->pageInternalSrc;
    }

    public function setPageExternalSrc($externalSrc) {
        $this->pageExternalSrc = $externalSrc;
    }

    public function getPageExternalSrc() {
        return $this->pageExternalSrc;
    }

} 