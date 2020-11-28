<?php

/** @var xPDOTransport $transport */

/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx = &$transport->xpdo;

    /** @var Mailing $mailing */
    $service = $modx->getService('mailing', 'Mailing', MODX_CORE_PATH . 'components/mailing/model/mailing/');
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $manager = $modx->getManager();
            $mapFile = $service->modelPath . $service::PKG_NAMESPACE . '/metadata.' . $modx->config['dbtype'] . '.php';
            include $mapFile;
            foreach ($xpdo_meta_map as $baseClass => $extends) {
                foreach ($extends as $className) {
                    $manager->createObjectContainer($className);
                }
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return true;
