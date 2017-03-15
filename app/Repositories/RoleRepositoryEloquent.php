<?php

namespace Portal\Repositories;

use Portal\Models\Role;
use Portal\Presenters\RolePresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RoleRepositoryEloquent
 * @package namespace Portal\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return RolePresenter::class;
    }

    public function getPermissions(int $id)
    {
        if(!$this->skipPresenter){
            return ['data'=> $this->model->find($id)->getPermissions()];
        }
        return $this->model->find($id)->getPermissions();
    }

    /**
     * @param int|string|collection|array $permUser
     * @return mixed
     *
     */
    public function assignPermission(int $roleId,$permUser)
    {
        return $this->model->find($roleId)->assignPermission($permUser);
    }

    /**
     * @param int|string|collection|array $permUser
     * @return mixed
     *
     */
    public function revokePermission(int $roleId,$permUser)
    {
        return $this->model->find($roleId)->assignPermission($permUser);
    }

    public function revokeAllPermissions(int $id){
        return $this->model->find($id)->revokeAllPermissions();
    }

    /**
     * @param int $roleId
     * @param array $roles
     * @return mixed
     */
    public function syncPermissions(int $roleId,array $permissions)
    {
        return $this->model->find($roleId)->syncPermissions($permissions);
    }
}