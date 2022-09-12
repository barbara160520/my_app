<?php

namespace App\Components;

class PieMessage
{
    public function __construct(public string $sms, public int $user_id)
    {
    }
}
