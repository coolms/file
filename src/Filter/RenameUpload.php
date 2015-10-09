<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Filter;

use Zend\Filter\Exception,
    Zend\Filter\File\RenameUpload as BaseRenameUpload;
use CmsFile\Stdlib\FileUtils;

class RenameUpload extends BaseRenameUpload
{
    /**
     * @var array
     */
    protected $options = [
        'target'               => null,
        'use_upload_name'      => null,
        'use_upload_extension' => null,
        'overwrite'            => null,
        'randomize'            => true,
        'store_levels'         => 0,
    ];

    /**
     * @var array
     */
    protected $uploadData = [];

    /**
     * {@inheritDoc}
     */
    public function setUseUploadName($flag = null)
    {
        if (null === $flag) {
            $this->options['use_upload_name'] = $flag;
        } else {
            parent::setUseUploadName($flag);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setUseUploadExtension($flag = null)
    {
        if (null === $flag) {
            $this->options['use_upload_extension'] = $flag;
        } else {
            parent::setUseUploadExtension($flag);
        }

        return $this;
    }

    /**
     * @param int $levels
     * @return self
     * @throws Exception\InvalidArgumentException
     */
    public function setStoreLevels($levels)
    {
        if (!is_numeric($levels)) {
            throw new Exception\InvalidArgumentException(
                'Invalid store levels size, must be an integer'
            );
        }

        $this->options['store_levels'] = $levels;
        return $this;
    }

    /**
     * @return int
     */
    public function getStoreLevels()
    {
        return $this->options['store_levels'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getFinalTarget($uploadData)
    {
        if (is_array($uploadData)) {
            $this->uploadData = $uploadData;
        }

        $target = parent::getFinalTarget($uploadData);

        $info = pathinfo($target);

        if ($this->getRandomize()) {
            $subPath = FileUtils::getStoreSubPath($info['filename'], $this->getStoreLevels());
        }

        if (!$subPath) {
            return $target;
        }

        $info['dirname'] .= DIRECTORY_SEPARATOR . $subPath;

        if (!is_dir($info['dirname'])) {
            mkdir($info['dirname'], 0755, true);
        }

        $path = realpath($info['dirname']) . DIRECTORY_SEPARATOR . $info['basename'];

        return $path;
    }

    /**
     * {@inheritDoc}
     */
    protected function applyRandomToFilename($source, $filename)
    {
        $info = pathinfo($filename);
        if ($this->getUseUploadName() !== null) {
            $filename = $info['filename'] . uniqid('_');
        } else {
            $filename = md5_file($this->uploadData['tmp_name']);
            if (null === $this->getOverwrite()) {
                $this->setOverwrite();
            }
        }

        $sourceinfo = pathinfo($source);

        $extension = '';
        if ($this->getUseUploadExtension() === true && isset($sourceinfo['extension'])) {
            $extension .= '.' . $sourceinfo['extension'];
        } elseif ($this->getUseUploadExtension() === false && isset($info['extension'])) {
            $extension .= '.' . $info['extension'];
        }

        return $filename . $extension;
    }
}
