<?php
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Validator;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\Validator\Regex,
    Zend\Validator\ValidatorChain;

class IdentityValidatorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $validators)
    {
        /* @var $options \CmsAuthentication\Options\InputFilterOptionsInterface */
        $options = $validators->getServiceLocator()->get('CmsAuthentication\\Options\\ModuleOptions');

        $chain = new ValidatorChain;

        $chain->attachByName('StringLength', [
            'min' => $options->getMinIdentityLength(),
            'max' => $options->getMaxIdentityLength(),
        ], true);

        if ($options->getIdentityRegexPattern()) {
            $chain->attachByName('Regex', [
                'messages' => [
                    Regex::NOT_MATCH => 'Incorrect identity. ' .
                        'Identity must contain alphanumeric characters without spaces',
                ],
                'pattern' => $options->getIdentityRegexPattern(),
            ], true);
        }

        return $chain;
    }
}
