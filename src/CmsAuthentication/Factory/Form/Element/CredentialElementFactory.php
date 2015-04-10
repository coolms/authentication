<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Form\Element;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Form\Element\Credential;

class CredentialElementFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $elements)
    {
        $parentLocator = $elements->getServiceLocator();

        /* @var $options \CmsAuthentication\Options\FormOptionsInterface */
        $options = $parentLocator->get('CmsAuthentication\\Options\\ModuleOptions');

        return new Credential(
            $options->getCredentialField() ?: 'credential',
            ['label' => $options->getCredentialFieldLabel() ?: 'Password']
        );
    }
}
