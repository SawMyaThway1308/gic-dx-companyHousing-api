<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Test extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    public $timestamps = false;

    // semoorDBのテーブル名
    protected $table = 't_test';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];
}
