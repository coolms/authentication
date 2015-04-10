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

use Zend\Authentication\Storage\StorageInterface,
    Zend\Authentication\Storage\Session;

abstract class AbstractAdapter implements ChainableAdapterInterface
{
    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * Returns the persistent storage handler
     *
     * Session storage is used by default unless a different storage adapter has been set.
     *
     * @return StorageInterface
     */
    public function getStorage()
    {
        if (null === $this->storage) {
            $this->setStorage(new Session(get_called_class()));
        }

        return $this->storage;
    }

    /**
     * Sets the persistent storage handler
     *
     * @param  Storage\StorageInterface $storage
     * @return self Provides a fluent interface
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * Check if this adapter is satisfied or not
     *
     * @return bool
     */
    public function isSatisfied()
    {
        $storage = $this->getStorage()->read();

        return (isset($storage['is_satisfied']) && true === $storage['is_satisfied']);
    }

    /**
     * Set if this adapter is satisfied or not
     *
     * @param bool $bool
     * @return self
     */
    public function setSatisfied($bool = true)
    {
        $storage = $this->getStorage()->read() ?: [];
        $storage['is_satisfied'] = $bool;
        $this->getStorage()->write($storage);

        return $this;
    }
}
