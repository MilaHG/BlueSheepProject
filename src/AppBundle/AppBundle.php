<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    
    # Overide FOSUserBundle
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
