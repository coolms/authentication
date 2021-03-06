<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Form\Element;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Form\Element\Identity,
    CmsAuthentication\Options\FormOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class IdentityElementFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Identity
     */
    public function createService(ServiceLocatorInterface $elements)
    {
        $parentLocator = $elements->getServiceLocator();

        /* @var $options FormOptionsInterface */
        $options = $parentLocator->get(ModuleOptions::class);

        return new Identity(
            $options->getIdentityField() ?: 'identity',
            ['label' => $options->getIdentityFieldLabel() ?: 'Identity']
        );
    }
}
