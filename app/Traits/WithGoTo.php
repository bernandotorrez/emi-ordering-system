<?php

namespace App\Traits;

trait WithGoTo {
    public function goTo($value)
    {
        return redirect()->to(url($value));
    }
}