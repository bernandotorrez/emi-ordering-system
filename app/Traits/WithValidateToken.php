<?php

namespace App\Traits;

trait WithValidateToken
{
    public function validateToken($data)
    {
        if(session()->get('level_access') != '1') {
            if($data['httpStatus'] == 401) {
                abort(401, 'Unauthorized action.');
            }
        }
        
        return $data;
    }
}