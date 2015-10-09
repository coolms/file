<?php 
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * Turn off strict options mode
     *
     * @var bool
     */
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $uploadFileLabel = 'Upload file';

    /**
     * @var bool
     */
    protected $allowMultipleUpload = true;

    /**
     * @var array
     */
    protected $uploadFileSizes = ['max' => 200000];

    /**
     * @var array
     */
    protected $uploadFileCounts = [];

    /**
     * @var array
     */
    protected $uploadFileMimeTypes = [];

    /**
     * @var string
     */
    protected $defaultUploadPath = '/uploads';

    /**
     * @var string|callable
     */
    protected $defaultUploadPathGenerator = 'CurrentDate';

    /**
     * @var string
     */
    protected $className = 'CmsFileORM\Entity\File';

    /**
     * @var string
     */
    protected $folderClassName = 'CmsFileORM\Entity\Folder';

    /**
     * @var string
     */
    protected $dataStorePath = 'data/files';

    /**
     * @var int
     */
    protected $storeLevels = 2;

    /**
     * @var string
     */
    protected $publicStorePath = 'public/files';

    /**
     * {@inheritDoc}
     */
    public function setUploadFileLabel($label)
    {
        $this->uploadFileLabel = $label;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadFileLabel()
    {
        return $this->uploadFileLabel;
    }

    /**
     * {@inheritDoc}
     */
    public function setAllowMultipleUpload($flag)
    {
        $this->allowMultipleUpload = (bool) $flag;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllowMultipleUpload()
    {
        return $this->allowMultipleUpload;
    }

    /**
     * {@inheritDoc}
     */
    public function setUploadFileSizes(array $fileSizes)
    {
        $this->uploadFileSizes = $fileSizes;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadFileSizes()
    {
        return $this->uploadFileSizes;
    }

    /**
     * {@inheritDoc}
     */
    public function setUploadFileCounts(array $fileCounts)
    {
        $this->uploadFileCounts = $fileCounts;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadFileCounts()
    {
        return $this->uploadFileCounts;
    }

    /**
     * {@inheritDoc}
     */
    public function setUploadFileMimeTypes(array $mimeTypes)
    {
        $this->uploadFileMimeTypes = $mimeTypes;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadFileMimeTypes()
    {
        return $this->uploadFileMimeTypes;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultUploadPath($path)
    {
        $this->defaultUploadPath = $path;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultUploadPath()
    {
        return $this->defaultUploadPath;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultUploadPathGenerator($generator)
    {
        $this->defaultUploadPathGenerator = $generator;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultUploadPathGenerator()
    {
        return $this->defaultUploadPathGenerator;
    }

    /**
     * {@inheritDoc}
     */
    public function setClassName($className)
    {
        $this->className = $className;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * {@inheritDoc}
     */
    public function setFolderClassName($className)
    {
        $this->folderClassName = $className;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFolderClassName()
    {
        return $this->folderClassName;
    }

    /**
     * {@inheritDoc}
     */
    public function setStoreLevels($levels)
    {
        $this->storeLevels = (int) $levels;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStoreLevels()
    {
        return $this->storeLevels;
    }

    /**
     * {@inheritDoc}
     */
    public function setDataStorePath($storePath)
    {
        $this->dataStorePath = $storePath;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDataStorePath()
    {
        return $this->dataStorePath;
    }

    /**
     * {@inheritDoc}
     */
    public function setPublicStorePath($storePath)
    {
        $this->publicStorePath = $storePath;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublicStorePath()
    {
        return $this->publicStorePath;
    }
}
