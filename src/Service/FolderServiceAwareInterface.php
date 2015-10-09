<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Service;

use CmsCommon\Service\DomainServiceInterface;

interface FolderServiceAwareInterface
{
    /**
     * @return DomainServiceInterface
     */
    public function getFolderService();

    /**
     * @param DomainServiceInterface $folderService
     */
    public function setFolderService(DomainServiceInterface $folderService);
}