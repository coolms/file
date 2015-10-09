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

use Zend\Form\Annotation as Form,
    Doctrine\Common\Collections\ArrayCollection,
    Doctrine\Common\Collections\Collection,
    CmsFile\Mapping\FolderInterface;

trait FoldersProviderTrait
{
    /**
     * @var FolderInterface
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
        $this->folders = new ArrayCollection();
    }

    /**
     * @param FolderInterface[] $folders
     */
    public function setFolders($folders)
    {
        $this->clearFolders();
        $this->addFolders($folders);
    }

    /**
     * @param FolderInterface[] $folders
     */
    public function addFolders($folders)
    {
        foreach ($folders as $folder) {
            $this->addFolder($folder);
        }
    }

    /**
     * @param FolderInterface $folder
     */
    public function addFolder(FolderInterface $folder)
    {
        $this->getFolders()->add($folder);
    }

    /**
     * @param FolderInterface[] $files
     */
    public function removeFolders($folders)
    {
        foreach ($folders as $folder) {
            $this->removeFolder($folder);
        }
    }

    /**
     * @param FolderInterface $folder
     */
    public function removeFolder(FolderInterface $folder)
    {
        $this->getFolders()->removeElement($folder);
    }

    /**
     * @param FolderInterface $folder
     * @return bool
     */
    public function hasFolder(FolderInterface $folder)
    {
        return $this->getFolders()->contains($folder);
    }

    /**
     * Removes all folders
     */
    public function clearFolders()
    {
        $this->getFiles()->clear();
    }

    /**
     * @return Collection
     */
    public function getFolders()
    {
        return $this->folders;
    }
}
