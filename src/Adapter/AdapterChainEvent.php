<?php 
/**
 * CoolMS2 Authentication Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/authentication for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Adapter;

use Zend\EventManager\Event,
    Zend\Stdlib\RequestInterface;

class AdapterChainEvent extends Event
{
    /**
     * Get identity
     *
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->getParam('identity');
    }

    /**
     * Set identity
     *
     * @param mixed $identity
     * @return self
     */
    public function setIdentity($identity = null)
    {
        if (null === $identity) {
            // Setting the identity to null resets the code and messages.
            $this->setCode();
            $this->setMessages();
        }

        $this->setParam('identity', $identity);

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->getParam('code');
    }

    /**
     * Set code
     *
     * @param int $code
     * @return self
     */
    public function setCode($code = null)
    {
        $this->setParam('code', $code);

        return $this;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->getParam('messages') ?: [];
    }

    /**
     * Set messages
     *
     * @param array $messages
     * @return self
     */
    public function setMessages($messages = [])
    {
        $this->setParam('messages', $messages);

        return $this;
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->getParam('request');
    }

    /**
     * Set request
     *
     * @param RequestInterface $request
     * @return self
     */
    public function setRequest(RequestInterface $request)
    {
        $this->setParam('request', $request);
        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdentityKey()
    {
        return $this->getParam('identityKey', 'identity');
    }

    /**
     * @param string $key
     * @return self
     */
    public function setIdentityKey($key)
    {
        $this->setParam('identityKey', $key);

        return $this;
    }

    /**
     * @return string
     */
    public function getCredentialKey()
    {
        return $this->getParam('credentialKey', 'credential');
    }

    /**
     * @param string $key
     * @return self
     */
    public function setCredentialKey($key)
    {
        $this->setParam('credentialKey', $key);

        return $this;
    }

    /**
     * @return int
     */
    public function getRememberMeTimeout()
    {
        return $this->getParam('rememberMeTimeout', 0);
    }

    /**
     * @param int $ttl
     * @return self
     */
    public function setRememberMeTimeout($ttl)
    {
        $this->setParam('rememberMeTimeout', $ttl);

        return $this;
    }
}
