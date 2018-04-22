<?php

namespace MyApp\FreelancerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FreelancerBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
