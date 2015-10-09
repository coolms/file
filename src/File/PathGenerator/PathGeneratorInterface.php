<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\File\PathGenerator;

/**
 * PathGeneratorInterface
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */

interface PathGeneratorInterface
{
    /**
     * Generates a directory path
     *
     * @param string $path Root path
     * @param object $object
     * @return string
     */
    public static function generate($path, $object = null);
}
