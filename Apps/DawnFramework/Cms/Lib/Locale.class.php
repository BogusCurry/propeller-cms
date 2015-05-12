<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 2015-05-06
 * Time: 9:27 AM
 */

namespace Apps\DawnFramework\Cms\Lib;

use \DawnFramework\Configuration;
use DawnFramework\HttpRequest;

class Locale {

    const   LOCALE_DEFAULT       = 'default';
    const   LOCALE_GET_PARAMETER = 'locale';

    private $configuration;
    private $fallbackLocale      = 'en_CA';
    private $locale;

    public function __construct(Configuration $configuration, HttpRequest $httpRequest)
    {
        $this->configuration = $configuration->getConfigurationValuesFromRootKey('locale');
        $this->setLocale($this->getLocaleFromGetParam($httpRequest));
    }

    public function getLocaleConfiguration($key) {
        return $this->configuration[$key];
    }

    private function getLocaleDefault() {
        return $this->configuration[self::LOCALE_DEFAULT];
    }

    private function getLocaleFromGetParam(HttpRequest $httpRequest)
    {
        if ($httpRequest->getExist(self::LOCALE_GET_PARAMETER)) {
            return $httpRequest->getParam(self::LOCALE_GET_PARAMETER);
        } else {
            if ($this->getLocaleDefault() != null) {
                return $this->getLocaleDefault;
            } else {
                return $this->fallbackLocale;
            }
        }
    }

    public function setLocale($locale) {
        $this->locale = $locale;
    }

} 