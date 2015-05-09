<?php

namespace Apps\DawnFramework\Cms\Lib;

use DawnFramework\Configuration;

class View extends Themes {


    protected $configuration;
    protected $theme;

    public function __construct(Configuration $configuration) {
        $this->configuration = $this->getThemeConfiguration($configuration);
        $this->setTheme($this->getThemeDefault());
        $this->setThemeComponents('header');
        $this->setThemeComponents('body');
        $this->setThemeComponents('footer');
        $this->renderThemeComponents();
    }

    public function getThemeConfiguration(Configuration $configuration) {
        return $configuration->getConfigurationValuesFromRootKey('theme');
    }

    public function getThemeDefault() {
        return $this->configuration['default'];
    }

} 