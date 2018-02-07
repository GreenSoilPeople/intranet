<?php

namespace App;


class Department extends Model
{

    protected $guarded = ['id'];
    

    public function parent()
    {
        return $this->belongsTo('App\Department', 'parentid');
    }

    public function children()
    {
        return $this->hasMany('App\Department', 'parentid');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee', 'DepartmentID');
    }

    public function employeeCount() {
        $emps = $this->employees->count();
        return $emps;
    }

    public function scopeRootDepartments($querry) {
        return $querry->WhereNull('parentid');
    }

}
