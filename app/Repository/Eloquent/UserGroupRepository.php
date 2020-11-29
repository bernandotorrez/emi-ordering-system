<?php

namespace App\Repository\Eloquent;

use App\Models\UserGroup;

class UserGroupRepository extends BaseRepository
{
    public function __construct(UserGroup $model)
    {
        parent::__construct($model);
    }
}