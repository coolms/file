<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Initializer;

use Zend\ServiceManager\AbstractPluginManager,
    Zend\ServiceManager\InitializerInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsFile\Options\ModuleOptionsInterface,
    CmsUser\Options\ModuleOptions,
    CmsFile\Service\FileServiceAwareInterface;

class FileServiceInitializer implements InitializerInterface
{
    /**
     * {@inheritDoc}
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof FileServiceAwareInterface) {
            if ($serviceLocator instanceof AbstractPluginManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }

            /* @var $options ModuleOptionsInterface */
            $options = $serviceLocator->get(ModuleOptions::class);
            $instance->setFileService($serviceLocator->get('DomainServiceManager')->get($options->getClassName()));
        }
    }
}
