<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Factory\Form\Element;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsFile\Form\Element\File,
    CmsFile\Options\ModuleOptionsInterface,
    CmsFile\Options\ModuleOptions;

class FileUploadElementFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return File
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();
        return $this->configureElement(new File(), $services);
    }

    /**
     * @param File $element
     * @param ServiceLocatorInterface $services
     * @return File
     */
    protected function configureElement(File $element, ServiceLocatorInterface $services)
    {
        /* @var $options ModuleOptionsInterface */
        $options = $services->get(ModuleOptions::class);

        $element->setAttributes([
            'multiple' => $options->getAllowMultipleUpload(),
        ]);

        $element->setOptions([
            'label' => $options->getUploadFileLabel(),
            'target_class' => $options->getClassName(),
        ]);

        $inputSpec = $element->getInputSpecification();

        $inputSpec['filters'][] = ['name' => 'FileUpload'];

        $inputSpec['validators'][] = [
            'name' => 'FileUploadFile',
        ];

        if ($options->getUploadFileSizes()) {
            $inputSpec['validators'][] = [
                'name' => 'FileSize',
                'options' => $options->getUploadFileSizes(),
            ];
        }

        if ($options->getUploadFileCounts()) {
            $inputSpec['validators'][] = [
                'name' => 'FileCount',
                'options' => $options->getUploadFileCounts(),
            ];
        }

        if ($options->getUploadFileMimeTypes()) {
            $inputSpec['validators'][] = [
                'name' => 'FileMimeType',
                'options' => $options->getUploadFileMimeTypes(),
            ];
        }

        $element->setInputSpecification($inputSpec);

        return $element;
    }
}
