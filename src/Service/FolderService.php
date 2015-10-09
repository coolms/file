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

use CmsCommon\Persistence\MapperInterface,
    CmsCommon\Service\DomainService,
    CmsFile\Persistence\FolderMapperInterface;

/**
 * FolderService
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 *
 * @method FolderMapperInterface getMapper()
 */
class FolderService extends DomainService implements FolderServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function setMapper(MapperInterface $mapper)
    {
        if (!$mapper instanceof FolderMapperInterface) {
            throw new \InvalidArgumentException(sprintf(
                '$mapper must be an instance of %s; %s given',
                FolderMapperInterface::class,
                get_class($mapper)
            ));
        }

        return parent::setMapper($mapper);
    }
}
