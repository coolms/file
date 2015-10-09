<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Factory\Mvc\Controller;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsFile\Mapping\FileInterface,
    CmsFile\Mvc\Controller\FileController,
    CmsFile\Options\ModuleOptions;

class FileControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return FileController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();

        return new FileController(
            $services->get('DomainServiceManager')->get(FileInterface::class),
            $services->get(ModuleOptions::class)
        );
    }
}
