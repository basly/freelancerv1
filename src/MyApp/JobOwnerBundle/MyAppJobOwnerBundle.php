<?php

namespace MyApp\JobOwnerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MyAppJobOwnerBundle extends Bundle
{
    public function getParent()
    {
        return 'NomayaSocialBundle';
    }
}
