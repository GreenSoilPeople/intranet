<?php

namespace App;
use Session;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //use SoftDeletes;

    protected $primaryKey = 'UID';
    //protected $dates = ['deleted_at'];


    public function getFullNameAttribute() {
        return $this->FirstName . ' ' . $this->LastName;
    }

    public function scopeActive($query) {
        return $query->WhereNull('plecat');
    }

    public function scopeInactive($query) {
        return $query->WhereNotNull('plecat');
    }

    public function scopeDefault($query) {
        return $query->leftjoin('Departments', 'Employees.DepartmentID', '=', 'Departments.id');
    }


    public static function scopeSearch($query, $searchString) {
        if ($searchString != null) {
            
            Session::put('search', $searchString);

            $searchValues = preg_split('/\s+/', $searchString, -1, PREG_SPLIT_NO_EMPTY);

            $query = Employee::Default()
                                ->Where(function ($q) use ($searchValues) {
                                    foreach ($searchValues as $value) {
                                        $q->Where(\DB::raw('CONCAT(FirstName, LastName, IFNULL(Extension, ""), IFNULL(Mobile, ""), Name, Title)'), 'like', "%{$value}%");
                                    }
                                });
            //dd($query->getQuery()->toSQL());
            return $query;

        }
    }



    public function scopeFilter($query, $searchString) {

        if ($searchString != null) {

            Session::put('search', $searchString);

            $cols = ['prenume'    => 'FirstName',
                    'nume'        => 'LastName',
                    'extensie'    => 'Extension',
                    'mobil'       => 'Mobile',
                    'departament' => 'Name',
                    'functie'     => 'Title',
                    'locatie'     => 'Location'
                    ];

            //$str = "bla dep: xyz mlz pre: 123 omg";
            $str = $searchString;
            $c=[];
            $s=[];
            $e=[];

            // split search string by <column>:<value>

            $char_buff = preg_split('/(\w+:\s?(?:\w+|"[\w\s]+"))/', $str, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            //preg_match('/(\w+:)\s?"([\w\s]+)"|\w+:\s?\w+/', $str, $matches);
            //$char_buff = $matches;

            //dd($char_buff);

            foreach ($char_buff as $val) {
                if (strpos($val , ":")) {
                    //array_push($c,trim($val));
                    $c[explode(":",$val)[0]] = trim(preg_replace('/("|\')/',"",explode(":",$val)[1]));

                } else {
                    foreach(explode(" ",trim($val)) as $v)
                    if(strlen(trim($v)) > 0) {
                        array_push($s, $v);
                    }
                }
            }
            
            //dd($c);

            foreach ($c as $k => $v) {
                $part = $k;
                foreach($cols as $key => $value) {
                    if (strtolower(substr($key,0,strlen($part))) == strtolower($part)) {
                        $e[$value]=$v;
                    }
                }
            }


            $query = Employee::Default();

            
            $query->Where(function ($q) use ($e) {
                foreach ($e as $key => $value) {
                    $q->Where($key, 'like', "%{$value}%");
                }
            });

            
            $cols = array_diff($cols, array_keys($e));

            $query->Where(function ($q) use ($s, $cols) {
                foreach ($s as $value) {
                    $q->Where(\DB::raw('CONCAT(IFNULL('. implode(', ""), IFNULL(',$cols) .',""))'), 'like', "%{$value}%");
                    //dd(\DB::raw('CONCAT(IFNULL('. implode(', ""), IFNULL(',$cols) .',""))'), 'like', "%{$value}%");
                }
            });

            return $query;

        }
    }



}
