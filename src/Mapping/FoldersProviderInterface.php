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

interface FoldersProviderInterface
{
    /**
     * @param FolderInterface[] $folders
     * @return self
     */
    public function setFolders($folders);

    /**
     * @param FolderInterface[] $folders
     * @return self
     */
    public function addFolders($folders);

    /**
     * @param FolderInterface $folder
     * @return self
     */
    public function addFolder(FolderInterface $folder);

    /**
     * @param FolderInterface[] $folders
     * @return self
     */
    public function removeFolders($folders);

    /**
     * @param FolderInterface $folder
     * @return self
     */
    public function removeFolder(FolderInterface $folder);

    /**
     * @param FolderInterface $folder
     * @return bool
     */
    public function hasFolder(FolderInterface $folder);

    /**
     * Removes all folders
     *
     * @return self
     */
    public function clearFolders();

    /**
     * @return FolderInterface[]
     */
    public function getFolders();
}
