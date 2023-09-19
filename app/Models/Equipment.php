<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 */
class Equipment extends Model
{
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    public $timestamps = false;

    // semoorDBのテーブル名
    protected $table = 't_equipment';

    protected $primaryKey = 'id';

    protected $fillable = [
        'equipment_name', 
        'purchase_year', 
        'maker', 
        'model', 
        'status', 
        'address_id',
        'registration_date', 
        'registration_time'
    ];

    // 備品情報テーブルと関係
    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
