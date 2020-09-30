<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\UserAttribute;
use App\Models\Auth\Traits\Method\UserMethod;
use App\Models\Auth\Traits\Relationship\UserRelationship;
use App\Models\Auth\Traits\Scope\UserScope;
use App\Models\Department;

/**
 * Class User.
 */
class User extends BaseUser
{
    use UserAttribute,
        UserMethod,
        UserRelationship,
        UserScope;

    public function department()
    {
        return $this->hasOne(Department::class, 'department_id', 'id');
    }
}
