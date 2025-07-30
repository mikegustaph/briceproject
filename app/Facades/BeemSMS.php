<?php
// app/Facades/BeemSMS.php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BeemSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'beem-sms';
    }
}
