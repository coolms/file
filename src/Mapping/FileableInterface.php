<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Mapping;

interface FileableInterface
{
    /**
     * @param FileInterface[] $files
     */
    public function setFiles($files);

    /**
     * @param FileInterface[] $files
     */
    public function addFiles($files);

    /**
     * @param FileInterface $file
     */
    public function addFile(FileInterface $file);

    /**
     * @param FileInterface[] $files
     */
    public function removeFiles($files);

    /**
     * @param FileInterface $file
     */
    public function removeFile(FileInterface $file);

    /**
     * @param FileInterface $file
     * @return bool
     */
    public function hasFile(FileInterface $file);

    /**
     * Removes all files
     */
    public function clearFiles();

    /**
     * @return FileInterface[]
     */
    public function getFiles();
}
