<?php 
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsFile for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Options;

interface ModuleOptionsInterface
{
    /**
     * @param string $label
     * @return self
     */
    public function setUploadFileLabel($label);

    /**
     * @return string
     */
    public function getUploadFileLabel();

    /**
     * @param bool $flag
     * @return self
     */
    public function setAllowMultipleUpload($flag);

    /**
     * @return bool
     */
    public function getAllowMultipleUpload();

    /**
     * @param array $fileSizes
     * @return self
     */
    public function setUploadFileSizes(array $fileSizes);

    /**
     * @return array
     */
    public function getUploadFileSizes();

    /**
     * @param array $fileCounts
     * @return self
     */
    public function setUploadFileCounts(array $fileCounts);

    /**
     * @return array
     */
    public function getUploadFileCounts();

    /**
     * @param array $mimeTypes
     * @return self
     */
    public function setUploadFileMimeTypes(array $mimeTypes);

    /**
     * @return array
     */
    public function getUploadFileMimeTypes();

    /**
     * @param string $path
     * @return self
     */
    public function setDefaultUploadPath($path);

    /**
     * @return string
     */
    public function getDefaultUploadPath();

    /**
     * @param string|callable $generator
     * @return self
     */
    public function setDefaultUploadPathGenerator($generator);

    /**
     * @return string
     */
    public function getDefaultUploadPathGenerator();

    /**
     * @param string $className
     * @return self
     */
    public function setClassName($className);

    /**
     * @return string
     */
    public function getClassName();

    /**
     * @param string $className
     * @return self
     */
    public function setFolderClassName($className);

    /**
     * @return string
     */
    public function getFolderClassName();

    /**
     * @param int $levels
     * @return self
     */
    public function setStoreLevels($levels);

    /**
     * @return int
     */
    public function getStoreLevels();

    /**
     * @param string $storePath
     * @return self
     */
    public function setDataStorePath($storePath);

    /**
     * @return string
     */
    public function getDataStorePath();

    /**
     * @param string $storePath
     * @return self
     */
    public function setPublicStorePath($storePath);

    /**
     * @return string
     */
    public function getPublicStorePath();
}
