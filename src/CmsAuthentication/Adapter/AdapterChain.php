<?php 
/**
 * CoolMS2 Authentication module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/CmsAuthentication for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsAuthentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result,
    Zend\EventManager\Event,
    Zend\EventManager\EventManagerAwareInterface,
    Zend\EventManager\EventManagerAwareTrait,
    Zend\Stdlib\RequestInterface,
    Zend\Stdlib\ResponseInterface,
    CmsAuthentication\Exception\AuthenticationEventException;

class AdapterChain implements AdapterInterface, EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /**
     * @var AdapterChainEvent
     */
    protected $event;

    /**
     * Returns the authentication result
     *
     * @return Result
     */
    public function authenticate()
    {
        $e = $this->getEvent();

        $result = new Result(
            $e->getCode(),
            $e->getIdentity(),
            $e->getMessages()
        );

        $this->resetAdapters();

        return $result;
    }

    /**
     * Set request
     *
     * @param  RequestInterface $request
     * @return ResponseInterface|bool
     * @throws AuthenticationEventException
     */
    public function setRequest(RequestInterface $request)
    {
        $e = $this->getEvent();
        $e->setRequest($request);

        $this->getEventManager()->trigger('authenticate.pre', $e);

        $result = $this->getEventManager()->trigger('authenticate', $e, function($test) {
            return ($test instanceof ResponseInterface);
        });

        if ($result->stopped()) {
            if($result->last() instanceof ResponseInterface) {
                return $result->last();
            }

            throw new AuthenticationEventException(sprintf(
                'Auth event was stopped without a response. Got "%s" instead',
                is_object($result->last()) ? get_class($result->last()) : gettype($result->last())
            ));
        }

        if ($e->getIdentity()) {
            $this->getEventManager()->trigger('authenticate.success', $e);
            return true;
        }

        $this->getEventManager()->trigger('authenticate.fail', $e);

        return false;
    }

    /**
     * resetAdapters
     *
     * @return self
     */
    public function resetAdapters()
    {
        $listeners = $this->getEventManager()->getListeners('authenticate');
        foreach ($listeners as $listener) {
            $listener = $listener->getCallback();
            if (is_array($listener) && $listener[0] instanceof ChainableAdapterInterface) {
                $listener[0]->getStorage()->clear();
            }
        }

        return $this;
    }

    /**
     * logoutAdapters
     *
     * @return EventManagerInterface
     */
    public function logoutAdapters()
    {
        //Adapters might need to perform additional cleanup after logout
        $this->getEventManager()->trigger('logout', $this->getEvent());
    }

    /**
     * Get the auth event
     *
     * @return AdapterChainEvent
     */
    public function getEvent()
    {
        if (null === $this->event) {
            $this->setEvent(new AdapterChainEvent);
            $this->event->setTarget($this);
        }

        return $this->event;
    }

    /**
     * Set an event to use during dispatch
     *
     * By default, will re-cast to AdapterChainEvent if another event type is provided.
     *
     * @param  Event $e
     * @return self
     */
    public function setEvent(Event $e)
    {
        if (!$e instanceof AdapterChainEvent) {
            $eventParams = $e->getParams();
            $e = new AdapterChainEvent();
            $e->setParams($eventParams);
        }

        $this->event = $e;

        return $this;
    }
}
