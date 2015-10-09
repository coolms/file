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
    CmsCommon\Mapping\Common\TitleableInterface;

interface FileInterface extends
    IdentifiableInterface,
    DescribableInterface,
    TitleableInterface,
    FoldersProviderInterface
{
    const ACCESS_SPECIAL = false;
    const ACCESS_PUBLIC  = true;

    /**
     * @param FolderInterface $folder
     */
    public function setFolder(FolderInterface $folder);

    /**
     * @return FolderInterface
     */
    public function getFolder();

    /**
     * @return string
     */
    public function getHash();

    /**
     * @param string $name
     */
    public function setFilename($name);

    /**
     * @return string
     */
    public function getFilename();

    /**
     * @param string $ext
     */
    public function setExtension($ext);

    /**
     * @return string
     */
    public function getExtension();

    /**
     * @param string $name
     */
    public function setBasename($name);

    /**
     * @return string
     */
    public function getBasename();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return number
     */
    public function getSize();

    /**
     * @param string $hidden
     */
    public function setIsHidden($hidden = true);

    /**
     * @return string
     */
    public function getIsHidden();

    /**
     * @param bool $access
     */
    public function setIsPublic($access = true);

    /**
     * @return bool
     */
    public function getIsPublic();

    /**
     * @param FolderInterface $folder
     * @return bool
     */
    public function isLink(FolderInterface $folder);
}
