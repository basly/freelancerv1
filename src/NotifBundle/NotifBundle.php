<?php

namespace NotifBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NotifBundle extends Bundle
{
    public function getParent()
    {
        return 'MgiletNotificationBundle';
    }
}
