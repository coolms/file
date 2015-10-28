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

interface UploadableInterface
{
    /**
     * @param array $fileInfo
     * @return self
     */
    public function setUpload(array $fileInfo);

    /**
     * @return array
     */
    public function getUpload();
}
