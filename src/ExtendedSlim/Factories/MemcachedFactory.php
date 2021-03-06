<?php namespace ExtendedSlim\Factories;

use Memcached;

class MemcachedFactory
{
    /**
     * @return Memcached
     */
    public function create(): Memcached
    {
        $memcached = new Memcached();
        $memcached->addServers([[env('MEMCACHE_HOST'), env('MEMCACHE_PORT')]]);

        return $memcached;
    }
}
