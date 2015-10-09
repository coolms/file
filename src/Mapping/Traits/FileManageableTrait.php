<?php
/**
 * CoolMS2 ORM storage adapter for CmsFile (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file-orm for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Mapping\Traits;

use Zend\Form\Annotation as Form,
    CmsFile\Mapping\FileManagerInterface;

trait FileManageableTrait
{
    /**
     * @var FileManagerInterface
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsFile\Mapping\FileManagerInterface",
     *      "is_collection":false,
     *      "options":{
     *          "label":"File Manager",
     *          "name":"fileManager",
     *          "text_domain":"CmsFile"}})
     * @Form\Flags({"priority":0})
     */
    protected $fileManager;

    /**
     * @param FileManagerInterface $manager
     */
    public function setFileManager(FileManagerInterface $manager)
    {
        $this->fileManager = $manager;
    }

    /**
     * @return FileManagerInterface
     */
    public function getFileManager()
    {
        return $this->fileManager;
    }
}
