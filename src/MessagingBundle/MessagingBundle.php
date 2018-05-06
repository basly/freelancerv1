<?php

namespace MessagingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MessagingBundle extends Bundle
{


    public $count;
    public function getParent()
    {
        return 'FOSMessageBundle';
    }
}
