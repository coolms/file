<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Mapping\Traits;

use ArrayObject,
    Zend\Form\Annotation as Form,
    CmsFile\Mapping\FolderInterface;

trait FoldersProviderTrait
{
    /**
     * @var FolderInterface[]
     *
     * @Form\Type("ObjectSelect")
     * @Form\Required(false)
     * @Form\Attributes({"multiple":true,"size":5})
     * @Form\Options({
     *      "target_class":"CmsFile\Mapping\FolderInterface",
     *      "label":"Select folders"})
     * @Form\Flags({"priority":0})
     */
    protected $folders = [];

    /**
     * __construct
     *
     * Initializes folders
     */
    public function __construct()
    {
        
    }

    /**
     * @param FolderInterface[] $folders
     * @return self
     */
    public function setFolders($folders)
    {
        $this->clearFolders();
        $this->addFolders($folders);

        return $this;
    }

    /**
     * @param FolderInterface[] $folders
     * @return self
     */
    public function addFolders($folders)
    {
        foreach ($folders as $folder) {
            $this->addFolder($folder);
        }

        return $this;
    }

    /**
     * @param FolderInterface $folder
     * @return self
     */
    public function addFolder(FolderInterface $folder)
    {
        $this->folders[] = $folder;
        return $this;
    }

    /**
     * @param FolderInterface[] $files
     * @return self
     */
    public function removeFolders($folders)
    {
        foreach ($folders as $folder) {
            $this->removeFolder($folder);
        }

        return $this;
    }

    /**
     * @param FolderInterface $folder
     * @return self
     */
    public function removeFolder(FolderInterface $folder)
    {
        foreach ($this->folders as $key => $entity) {
            if ($file === $entity) {
                unset($this->folders[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * @param FolderInterface $folder
     * @return bool
     */
    public function hasFolder(FolderInterface $folder)
    {
        foreach ($this->folders as $entity) {
            if ($folder === $entity) {
                return true;
            }
        }

        return false;
    }

    /**
     * Removes all folders
     *
     * @return self
     */
    public function clearFolders()
    {
        $this->removeFolders($this->folders);
        return $this;
    }

    /**
     * @return FolderInterface[]
     */
    public function getFolders()
    {
        return $this->folders;
    }
}
