<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 16/5/22
 * Time: 下午10:32
 */

namespace Decii\App\Util;

use Illuminate\Database\Capsule\Manager;

class QueryBuilder
{
    private $qb;

    private $sqls;

    private $wheres;
    private function __construct($tableName)
    {
        $sqls[]= 'select * from '.$tableName;
    }

    public function table($tableName)
    {
        $this->qb =new QueryBuilder($tableName);
        return $this->qb;
    }

    public function where($key,$flag,$value)
    {
        $wheres[]= '('.$key.''.$flag.''.$value.')';
        return $this->qb;
    }

    public function orWhere($key,$flag,$value)
    {
        $wheres[]= 'or ('.$key.''.$flag.''.$value.')';
        return $this->qb;
    }

    public function andWhere($key,$flag,$value)
    {
        $wheres[]= ' and ('.$key.''.$flag.''.$value.')';
        return $this->qb;
    }

    public function build(){




    }

}