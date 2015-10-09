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

use CmsCommon\Mapping\Common\DescribableInterface,
    CmsCommon\Mapping\Common\IdentifiableInterface,
    CmsCommon\Mapping\Common\NameableInterface,
    CmsCommon\Mapping\Common\TitleableInterface,
    CmsCommon\Mapping\Hierarchy\HierarchyInterface,
    CmsCommon\Mapping\Dateable\TimestampableInterface;

interface FolderInterface extends
    DescribableInterface,
    FileableInterface,
    FoldableInterface,
    HierarchyInterface,
    IdentifiableInterface,
    NameableInterface,
    TitleableInterface,
    TimestampableInterface
{
    /**
     * @param string $path
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param int|string $idOrName
     * @return FileInterface
     */
    public function getFile($idOrName);

    /**
     * @param int|string $idOrName
     * @return FolderInterface
     */
    public function getFolder($idOrName);
}
