<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Employee extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    public $timestamps = false;

    // semoorDBのテーブル名
    protected $table = 't_employee';

    protected $keyType = 'string';

    protected $primaryKey = 'employee_id';

    protected $fillable = ['employee_id', 'employee_name'];
}
