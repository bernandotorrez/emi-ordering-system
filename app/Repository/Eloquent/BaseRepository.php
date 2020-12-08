<?php

namespace App\Repository\Eloquent;
use App\Repository\Eloquent\BaseInterface;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseInterface
{
    protected $model;
    protected $primaryKey;
    protected $searchableColumn;
    protected $visibleColumn;

    public function __construct($model)
    {
        $this->model = $model;
        $this->primaryKey = (new $model)->getKeyName();
        $this->searchableColumn = (new $model)->getSearchableColumn();
        //$this->visibleColumn = (new $model)->getVisible();
    }

    /**
     * Get All Data
     * @param array $column
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get All Data Active (Status = 1)
     * @return Collection
     */
    public function allActive()
    {
        return $this->model->where('status', '1')->get();
    }

    /**
     * Get All Data Active (Status = 1)
     * @param array $with
     * @return Collection
     */
    public function allActiveWithRelation(array $with)
    {
        return $this->model->where('status', '1')->with($with)->get();
    }

    /**
     * Insert Data
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Check Duplicated Data
     * @param array $where
     */
    public function findDuplicate(array $where)
    {
        return $this->model->where($where)->where('status', '1')->count();
    }

    /**
     * Check Duplicated Data in Edit Process
     * @param array $where
     * @param int|string $id
     */
    public function findDuplicateEdit(array $where, $id)
    {
        return $this->model->where($where)->where('status', '1')->where($this->primaryKey, '!=', $id)->count();
    }

    /**
     * Update Data
     * @param string $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        return $this->model->where($this->primaryKey, $id)->update($data);
    }

    /**
     * Update Data
     * @param array $id
     * @param array $data
     */
    public function massUpdate(array $id, array $data)
    {
        return $this->model->whereIn($this->primaryKey, $id)->update($data);
    }

    /**
     * Delete One Data
     * @param int $id
     */
    public function delete(int $id)
    {
        return $this->model->where($this->primaryKey, $id)->delete();
    }

    /**
     * Delete Many Data
     * @param array $id
     */
    public function massDelete(array $id)
    {
        return $this->model->whereIn($this->primaryKey, $id)->update(['status' => '0']);
    }

    /**
     * Get Data By ID
     * @param $id
     */
    public function getById($id)
    {
        return $this->model->where($this->primaryKey, $id)->get()->first();
    }

    /**
     * Get Primary Key of the Model
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * Get Visible Column of the Model
     * App\Model, protected $visible = [];
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Get Data With Pagination
     * @param array $arrayField
     * @param string $search
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     */
    public function pagination(
        string $search = '',
        string $sortBy,
        string $sortDirection = 'asc',
        int $perPage
    )
    {
        $searchableColumn = $this->searchableColumn;
        $countField = count($searchableColumn);

        $data = $this->model;
        $data = $data->where(function($query) use ($searchableColumn, $countField, $search) {
            if($countField >= 1) {
                for($i=0;$i <= $countField-1;$i++) {
                    if($i == 0) {
                        $query = $query->where($searchableColumn[$i], 'like', '%'.$search.'%');
                    } else {
                        $query = $query->orWhere($searchableColumn[$i], 'like', '%'.$search.'%');
                    }
                }
            }
        });
        $data = $data->where('status', '1');
        $data = $data->orderBy($sortBy, $sortDirection);
        $data = $data->paginate($perPage);

        return $data;
    }

    /**
     * Get Data Checked With Pagination
     * @param array $arrayField
     * @param string $search
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     */
    public function checked(
        string $search = '',
        string $sortBy,
        string $sortDirection = 'asc',
        int $perPage
    )
    {
        $arrayField = $this->searchableColumn;
        $countField = count($arrayField);

        $data = $this->model;
        $data = $data->select($this->primaryKey);
        $data = $data->where(function($query) use ($arrayField, $countField, $search) {
            if($countField >= 1) {
                for($i=0;$i <= $countField-1;$i++) {
                    if($i == 0) {
                        $query = $query->where($arrayField[$i], 'like', '%'.$search.'%');
                    } else {
                        $query = $query->orWhere($arrayField[$i], 'like', '%'.$search.'%');
                    }
                }
            }
        });
        $data = $data->where('status', '1');
        $data = $data->orderBy($sortBy, $sortDirection);
        $data = $data->paginate($perPage);

        return $data;
    }

    /**
     * Get Data Pagination With Query View
     * @param string $viewName
     * @param array $arrayField
     * @param string $search
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     */
    public function viewPagination(
        string $viewName,
        string $search = '',
        string $sortBy,
        string $sortDirection = 'asc',
        int $perPage
    )
    {
        $arrayField = $this->searchableColumn;
        $countField = count($arrayField);

        $data = DB::table($viewName);
        $data = $data->where(function($query) use ($arrayField, $countField, $search) {
            if($countField >= 1) {
                for($i=0;$i <= $countField-1;$i++) {
                    if($i == 0) {
                        $query = $query->where($arrayField[$i], 'like', '%'.$search.'%');
                    } else {
                        $query = $query->orWhere($arrayField[$i], 'like', '%'.$search.'%');
                    }
                }
            }
        });
        $data = $data->where('status', '1');
        $data = $data->orderBy($sortBy, $sortDirection);
        $data = $data->paginate($perPage);

        return $data;
    }

    /**
     * Get Data Pagination With Query View
     * @param string $viewName
     * @param array $arrayField
     * @param string $search
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     */
    public function viewChecked(
        string $viewName,
        string $search = '',
        string $sortBy,
        string $sortDirection = 'asc',
        int $perPage
    )
    {
        $arrayField = $this->searchableColumn;
        $countField = count($arrayField);

        $data = DB::table($viewName);
        $data = $data->select($this->primaryKey);
        $data = $data->where(function($query) use ($arrayField, $countField, $search) {
            if($countField >= 1) {
                for($i=0;$i <= $countField-1;$i++) {
                    if($i == 0) {
                        $query = $query->where($arrayField[$i], 'like', '%'.$search.'%');
                    } else {
                        $query = $query->orWhere($arrayField[$i], 'like', '%'.$search.'%');
                    }
                }
            }
        });
        $data = $data->where('status', '1');
        $data = $data->orderBy($sortBy, $sortDirection);
        $data = $data->paginate($perPage);

        return $data;
    }

    /**
     * Get Data Pagination With Relation Eager Loading
     * @param array $with
     * @param string $search
     * @param string $sortBy
     * @param string $sortDirection
     * @param int $perPage
     */
    public function paginationWithRelation(
        string $search = '',
        string $sortBy,
        string $sortDirection = 'asc',
        int $perPage,
        array $with = []
    )
    {
        $searchableColumn = $this->searchableColumn;
        $countField = count($searchableColumn);

        $data = $this->model;
        $data = $data->with($with);
        $data = $data->where(function($query) use ($searchableColumn, $countField, $search) {
            if($countField >= 1) {
                for($i=0;$i <= $countField-1;$i++) {
                    if($i == 0) {
                        $query = $query->where($searchableColumn[$i], 'like', '%'.$search.'%');
                    } else {
                        $query = $query->orWhere($searchableColumn[$i], 'like', '%'.$search.'%');
                    }
                }
            }
        });
        $data = $data->where('status', '1');
        $data = $data->orderBy($sortBy, $sortDirection);
        $data = $data->paginate($perPage);

        return $data;
    }
}