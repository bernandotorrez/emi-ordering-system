<?php

namespace App\Repository\Eloquent;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $id
     */
    public function massDeleteUser(array $id)
    {
        return $this->model->where('is_from_wrs', '!=', '1')->whereIn($this->primaryKey, $id)->delete();
    }
}