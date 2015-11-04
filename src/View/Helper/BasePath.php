<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\View\Helper;

use Zend\View\Exception,
    Zend\View\Helper\AbstractHelper,
    Zend\View\Helper\BasePath as BasePathHelper,
    CmsFile\Mapping\FileInterface;

/**
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class BasePath extends AbstractHelper
{
    /**
     * Base path
     *
     * @var string
     */
    protected $basePath = '/files';

    /**
     * @var BasePathHelper
     */
    protected $basePathHelper;

    /**
     * @var string
     */
    protected $defaultBasePathHelper = 'basePath';

    /**
     * @param string|FileInterface $file
     * @return string
     */
    public function __invoke($file)
    {
        if ($file instanceof FileInterface) {
            $file = $file->getUri();
        }

        if (!$file || !is_string($file)) {
            throw new Exception\RuntimeException('No file path provided');
        }

        $file = $this->basePath . '/' . ltrim($file, '/');

        $basePathHelper = $this->getBasePathHelper();
        return $basePathHelper($file);
    }

    /**
     * @return BasePathHelper
     */
    protected function getBasePathHelper()
    {
        if (null === $this->basePathHelper) {
            $renderer = $this->getView();
            if (method_exists($renderer, 'plugin')) {
                $this->basePathHelper = $renderer->plugin($this->defaultBasePathHelper);
            }

            if (!$this->basePathHelper instanceof BasePathHelper) {
                $this->basePathHelper = new BasePathHelper();
                $this->basePathHelper->setBasePath('/');
                $this->basePathHelper->setView($this->getView());
            }
        }

        return $this->basePathHelper;
    }

    /**
     * Set the base path.
     *
     * @param  string $basePath
     * @return self
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '/');
        return $this;
    }
}
