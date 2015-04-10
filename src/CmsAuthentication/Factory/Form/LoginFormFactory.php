<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Form;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsAuthentication\Form\Login;

class LoginFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $elements)
    {
        $parentLocator = $elements->getServiceLocator();

        /* @var $options \CmsAuthentication\Options\FormOptionsInterface */
        $options = $parentLocator->get('CmsAuthentication\\Options\\ModuleOptions');
        $options = $options->toArray();

        // Use submit button by default
        if (!isset($options['use_submit_element'])) {
            $options['use_submit_element'] = true;
        }

        return new Login('login', $options);
    }
}
