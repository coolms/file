<?php
/**
 * CoolMS2 File Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/file for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsFile\Form\Element;

use Zend\Form\Element\File as BaseFile;

class File extends BaseFile
{
    /**
     * @var array
     */
    protected $inputSpecification;

    /**
     * {@inheritDoc}
     */
    public function getInputSpecification()
    {
        if (null === $this->inputSpecification) {
            return parent::getInputSpecification();
        }

        return $this->inputSpecification;
    }

    /**
     * @param array $inputSpec
     * @return self
     */
    public function setInputSpecification(array $inputSpec)
    {
        $this->inputSpecification = $inputSpec;
        return $this;
    }
}
