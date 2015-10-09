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
    CmsFile\Mapping\FileInterface;

trait FileableTrait
{
    /**
     * @var FileInterface[]
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsFile\Mapping\FileInterface",
     *      "is_collection":true,
     *      "options":{
     *          "allow_add":false,
     *          "allow_remove":true,
     *          "count":0,
     *          "label":"Files",
     *          "name":"files",
     *          "partial":"cms-file/file/fieldset",
     *          "should_create_template":true,
     *          "text_domain":"CmsFile",
     *      }})
     * @Form\Flags({"priority":0})
     */
    protected $files = [];

    /**
     * __construct
     *
     * Initializes files
     */
    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    /**
     * @param FileInterface[] $files
     */
    public function setFiles($files)
    {
        $this->clearFiles();
        $this->addFiles($files);
    }

    /**
     * @param FileInterface[] $files
     */
    public function addFiles($files)
    {
        foreach ($files as $file) {
            $this->addFile($file);
        }
    }

    /**
     * @param FileInterface $file
     */
    public function addFile(FileInterface $file)
    {
        $this->getFiles()->add($file);
    }

    /**
     * @param FileInterface[] $files
     */
    public function removeFiles($files)
    {
        foreach ($files as $file) {
            $this->removeFile($file);
        }
    }

    /**
     * @param FileInterface $file
     */
    public function removeFile(FileInterface $file)
    {
        $this->getFiles()->removeElement($file);
    }

    /**
     * @param FileInterface $file
     * @return bool
     */
    public function hasFile(FileInterface $file)
    {
        return $this->getFiles()->contains($file);
    }

    /**
     * Removes all files
     */
    public function clearFiles()
    {
        $this->getFiles()->clear();
    }

    /**
     * @return Collection
     */
    public function getFiles()
    {
        return $this->files;
    }
}
