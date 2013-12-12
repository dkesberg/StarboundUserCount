<?php
/**
 * @author      Daniel Kesberg <kesberg@ebene3.com>
 * @copyright   (c) 2013, Daniel Kesberg
 */

namespace dkesberg\Starbound;

class Server {

    /**
     * @var mixed
     */
    protected $clients;

    /**
     * @return int
     */
    public function getClientCount()
    {
        if ($this->clients == null) {
            return 0;
        }        
        return count($this->clients);
    }
    
    public function isOnline()
    {
        
    }
    
}
