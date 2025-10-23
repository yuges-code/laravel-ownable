<?php

namespace Yuges\Ownable\Options;

use Yuges\Ownable\Config\Config;

class OwnableOptions
{
    /**
     * Auto own
     * 
     * @var bool
     */
    public bool $auto = true;

    public function __construct()
    {
        $this->auto = Config::getPermissionsOwnAuto($this->auto);
    }
}
