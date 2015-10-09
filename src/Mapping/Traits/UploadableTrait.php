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

use Zend\Form\Annotation as Form;

trait UploadableTrait
{
    /**
     * @var array
     *
     * @Form\Type("FileUpload")
     * @Form\Flags({"priority":0})
     */
    protected $upload;

    /**
     * @param array $fileInfo
     */
    public function setUpload(array $fileInfo)
    {
        $this->upload = $fileInfo;
    }

    /**
     * @return array
     */
    public function getUpload()
    {
        return $this->upload;
    }
}
