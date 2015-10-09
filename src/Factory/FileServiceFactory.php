<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsFile\Options\ModuleOptionsInterface,
    CmsFile\Options\ModuleOptions,
    CmsFile\Service\FileService;

class FileServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return FileService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();

        /* @var $options ModuleOptionsInterface */
        $options = $services->get(ModuleOptions::class);

        return new FileService($options, $serviceLocator);
    }
}
