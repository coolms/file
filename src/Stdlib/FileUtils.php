<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Stdlib;

use CmsCommon\Stdlib\FileUtils as BaseFileUtils;

/**
 * FileUtils
 *
 * Declared abstract, as we have no need for instantiation.
 */
abstract class FileUtils extends BaseFileUtils
{
    /**
     * @param string $uid
     * @param string $levels
     * @return boolean|string
     */
    public static function getStoreSubPath($uid, $levels)
    {
        if (!ctype_xdigit($uid)) {
            return false;
        }

        $subPath = [];
        for ($i = 0; $i < $levels; $i++) {
            $subPath[] = $uid[$i];
        }

        return implode(DIRECTORY_SEPARATOR, $subPath);
    }
}
