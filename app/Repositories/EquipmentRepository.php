<?php

namespace App\Repositories;

use App\Models\Equipment;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
 * 備品リポジトリ
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
class EquipmentRepository extends AbstractRepository
{
    /**
     * 関連のモデルを指定する
     */
    public function getModelClass(): string
    {
        return Equipment::class;
    }

    /**
     * 備品リストを取得する
     *
     * @return Collection データリスト
     */
    public function searchEquipment(Request $request): Collection
    {
        $equipmentName = $request->equipment_name;

        // 対象項目を指定しない場合、全てのデータを取得する
        return $this->model
        ->when($equipmentName, function ($query) use ($equipmentName) {
            $query->where('equipment_name', 'LIKE', "%{$equipmentName}%");
        })->get();
    }

    /**
     * 備品リストを取得する
     *
     * @return Collection データリスト
     */
    public function getEquipmentById(string $equipmentId): ?Collection
    {
        // 対象項目を指定しない場合、全てのデータを取得する
        return $this->model->where('id', $equipmentId)->get();
    }
}
