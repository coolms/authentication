<?php
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Factory\Validator;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\Validator\Regex,
    Zend\Validator\ValidatorChain,
    CmsAuthentication\Options\InputFilterOptionsInterface,
    CmsAuthentication\Options\ModuleOptions;

class IdentityValidatorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return ValidatorChain
     */
    public function createService(ServiceLocatorInterface $validators)
    {
        /* @var $options InputFilterOptionsInterface */
        $options = $validators->getServiceLocator()->get(ModuleOptions::class);

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
