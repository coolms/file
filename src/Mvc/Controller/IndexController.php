<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Mvc\Controller;

use Zend\Http\Headers,
    Zend\Http\Response\Stream,
    Zend\Mvc\Controller\AbstractActionController,
    Zend\Stdlib\ResponseInterface as Response,
    CmsCommon\Service\DomainServiceInterface,
    CmsFile\Service\FolderServiceAwareTrait;

class IndexController extends AbstractActionController
{
    use FolderServiceAwareTrait;

    /**
     * __construct
     *
     * @param DomainServiceInterface $folderService
     */
    public function __construct(DomainServiceInterface $folderService)
    {
        $this->setFolderService($folderService);
    }

    /**
     * {@inheritDoc}
     *
     * @return Stream|Response
     */
    public function indexAction()
    {
        $response = $this->getResponse();

        $params = $this->params()->fromRoute();
        if ($params['path'] === '') {
            $response->setStatusCode(404);
            return $response;
        }

        $info = pathinfo($params['path']);

        if ($info['dirname'] === '.') {
            $info['dirname'] = '';
        }

        /* @var $folder \CmsFile\Mapping\FolderInterface */
        $folder  = $this->getFolderService()->getMapper()->findOneByPath('/' . trim($info['dirname'], '/'));
        if (!$folder) {
            $response->setStatusCode(404);
            return $response;
        }

        $file = $folder->getFile($info['basename']);
        if (!$file) {
            $response->setStatusCode(404);
            return $response;
        }

        $response = new Stream;
        $response->setStream(fopen($file, 'r'));
        $response->setStatusCode(200);

        $headers = new Headers;
        $headers->addHeaderLine('Content-Type', $file->getType())
            ->addHeaderLine('Content-Disposition', 'attachment; filename="' . $file->getTitle() . '"')
            ->addHeaderLine('Content-Length', filesize($file));

        $response->setHeaders($headers);

        return $response;
    }
}
