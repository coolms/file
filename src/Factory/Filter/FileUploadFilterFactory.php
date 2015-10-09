<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Factory\Filter;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsFile\Filter\RenameUpload,
    CmsFile\Options\ModuleOptionsInterface,
    CmsFile\Options\ModuleOptions;

class FileUploadFilterFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return RenameUpload
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();

        /* @var $options ModuleOptionsInterface */
        $options = $services->get(ModuleOptions::class);

        $filter = new RenameUpload([
            'store_levels' => $options->getStoreLevels(),
            'target' => $options->getDataStorePath(),
        ]);

        return $filter;
    }
}
