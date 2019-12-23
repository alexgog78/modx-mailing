<?php

if (!class_exists('amHandler')) {
    require_once MODX_CORE_PATH . 'components/abstractmodule/handlers/handler.class.php';
}

class mailingEmailHandler extends amHandler
{
    /** @var ms2extendProductTab */
    //private $productTabFactory;

    /** @var modManagerController */
    //private $controller;

    /** @var array */
    //private $tabsIds = [];

    /** @var array */
    //private $tabs = [];

    /**
     * abstractHandler constructor.
     * @param abstractModule $module
     * @param array $config
     */
    /*public function __construct(& $module, array $config = [])
    {
        parent::__construct($module, $config);
        $this->productTabFactory = $this->modx->newObject('ms2extendProductTab');
    }*/
}
