<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Address extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    public $timestamps = false;

    // semoorDBのテーブル名
    protected $table = 't_address';

    protected $primaryKey = 'id';

    protected $fillable = [
        'address', 
        'type', 
        'use_start_date', 
        'contract_end_date', 
        'rent', 
        'capacity', 
        'contract_type', 
        'status', 
        'registration_date', 
        'registration_time', 
    ];

    // 備品情報テーブルと関係
    public function equipment()
    {
        return $this->hasOne(Equipment::class, 'address_id', 'id');
    }
}
