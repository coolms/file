<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\File;

use Zend\EventManager\Event,
    Zend\EventManager\AbstractListenerAggregate,
    Zend\EventManager\EventManagerInterface,
    Zend\Http\Request,
    Zend\Mvc\MvcEvent,
    CmsCommon\Stdlib\OptionsProviderTrait,
    CmsFile\File\PathGenerator\PathGeneratorInterface,
    CmsFile\Mapping\FileInterface,
    CmsFile\Mapping\FolderInterface,
    CmsFile\Options\ModuleOptionsInterface,
    CmsFile\Service\FileServiceInterface,
    CmsFile\Service\FolderServiceInterface,
    CmsFile\Service\FileServiceAwareTrait,
    CmsFile\Service\FolderServiceAwareTrait;

/**
 * Uploadable event listener
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 *
 * @method ModuleOptionsInterface getOptions()
 */
abstract class AbstractUploadableManager extends AbstractListenerAggregate implements UploadableManagerInterface
{
    use FileServiceAwareTrait,
        FolderServiceAwareTrait,
        OptionsProviderTrait;

    const INIT_EVENT    = MvcEvent::EVENT_DISPATCH;
    const INIT_PRIORITY = 1000;

    /**
     * Default path to save files in
     *
     * @var string
     */
    protected $defaultPath;

    /**
     * Default path generator
     *
     * @var PathGeneratorInterface
     */
    protected $defaultPathGenerator;

    /**
     * __construct
     *
     * @param ModuleOptionsInterface $config
     * @param FileServiceInterface $fileService
     * @param FolderServiceInterface $folderService
     */
    public function __construct(
        ModuleOptionsInterface $options,
        FileServiceInterface $fileService,
        FolderServiceInterface $folderService
    ) {
        $this->setOptions($options);
        $this->setFileService($fileService);
        $this->setFolderService($folderService);
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
    	$this->listeners[] = $events->attach(static::INIT_EVENT, [$this, 'init'], static::INIT_PRIORITY);
    }

    /**
     * Event callback to be triggered on dispatch
     *
     * @param MvcEvent $e
     */
    public function init(MvcEvent $e)
    {
        $request = $e->getRequest();
        if (!$request instanceof Request) {
            return;
        }

        $sem = $e->getApplication()->getEventManager()->getSharedManager();
        $sem->attach('UploadableManager', 'createFile', [$this, 'onCreateFile']);
    }

    /**
     * @param Event $params
     */
    public function onCreateFile(Event $params)
    {
        /* @var $file FileInterface */
        $file           = $params->getParam('file');
        $fileInfoArray  = $params->getParam('fileInfoArray');
        $pathGenerator  = $params->getParam('pathGenerator');

        $pathGenerator = $pathGenerator
            ? $this->normalizePathGenerator($pathGenerator)
            : $this->getDefaultPathGenerator();

        $path   = $this->getPath($pathGenerator, $file);
        $folder = $this->getUploadFolderByPath($path);

        $file->setFolder($folder);
        $file->setBasename($fileInfoArray['name']);
    }

    /**
     * @param null|callable|PathGeneratorInterface $pathGenerator
     * @param object $object
     * @return string
     */
    protected function getPath($pathGenerator = null, $object = null)
    {
        $path = $this->getDefaultPath();

        $generator = $pathGenerator
            ? $this->normalizePathGenerator($pathGenerator)
            : $this->getDefaultPathGenerator();

        if (!$generator) {
            return $path;
        }

        if ($generator instanceof PathGeneratorInterface) {
            $path = $generator::generate($path, $object);
        } else {
            $path = call_user_func_array($generator, [$path, $object]);
        }

        return $path;
    }

    /**
     * @param string $path
     * @throws \RuntimeException
     * @return FolderInterface
     */
    protected function getUploadFolderByPath($path)
    {
        $mapper = $this->getFolderService()->getMapper();
        /* @var $folder \CmsFile\Mappping\FolderInterface */
        $folder = $mapper->createFromPath($path, true);
        if (!$folder) {
            throw new \RuntimeException('Can\'t get upload directory');
        }

        return $folder;
    }

    /**
     * Sets the path generator
     *
     * @param PathGeneratorInterface|string|callable $generator
     * @return void
     */
    public function setDefaultPathGenerator($generator)
    {
        $this->defaultPathGenerator = $this->normalizePathGenerator($generator);
    }

    /**
     * Returns path generator
     *
     * @return PathGeneratorInterface
     */
    public function getDefaultPathGenerator()
    {
        if (null === $this->defaultPathGenerator) {
            $this->setDefaultPathGenerator($this->getOptions()->getDefaultUploadPathGenerator());
        }

        return $this->defaultPathGenerator;
    }

    /**
     * @param string|callable|PathGeneratorInterface $generator
     * @throws \InvalidArgumentException
     * @return callable|PathGeneratorInterface
     */
    protected function normalizePathGenerator($generator)
    {
        if (is_callable($generator) || $generator instanceof PathGeneratorInterface) {
            return $generator;
        }

        if (is_string($generator)) {
            if(class_exists($generator)) {
                return new $generator;
            }
    
            $class = 'CmsFile\\File\\PathGenerator\\' . $generator . 'PathGenerator';
            if(class_exists($class)) {
                return new $class;
            }
        }

        throw new \InvalidArgumentException(sprintf(
            '$generator must be callable, a valid class name or an object implementing %s; %s given',
            PathGeneratorInterface::class,
            is_object($generator) ? get_class($generator) : gettype($generator)
        ));
    }

    /**
     * Sets the default path
     *
     * @param string $path
     * @return void
     */
    public function setDefaultPath($path)
    {
        $this->defaultPath = $path;
    }

    /**
     * Returns default path
     *
     * @return string
     */
    public function getDefaultPath()
    {
        if (null === $this->defaultPath) {
            $this->setDefaultPath($this->getOptions()->getDefaultUploadPath());
        }

        return $this->defaultPath;
    }
}
