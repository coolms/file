<?php
/**
 * CoolMS2 ORM storage adapter for CmsFile (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file-orm for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Persistence;

use CmsCommon\Persistence\MapperInterface,
    CmsFile\Mapping\FolderInterface;

interface FolderMapperInterface extends MapperInterface
{
    /**
     * @param string $path
     * @param bool $recursive
     * @return FolderInterface
     */
    public function createFromPath($path, $recursive = true);
}
