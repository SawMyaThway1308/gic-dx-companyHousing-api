<?php

namespace App\Services;

use App\Repositories\EquipmentRepository;
use App\Repositories\AddressRepository;
use App\Traits\LogTrait;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * 備品ーサービス
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
class EquipmentService
{
    use LogTrait;

    private $equipmentRepository;

    private $addressRepository;

    /**
     * コンストラクタ
     */
    public function __construct(EquipmentRepository $equipmentRepository, AddressRepository $addressRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * 備品リストを取得する
     *
     * @return Collection メニューリスト
     */
    public function getAll(): Collection
    {
        // ログ出力する
        $this->infoLog(__FUNCTION__);
        return $this->equipmentRepository->getAll();
    }

    /**
     * 対象備品リストを取得する
     *
     * @return Collection 担当者リスト
     */
    public function searchEquipment(Request $request): Collection
    {
        // 備品リストを取得して返却する
        return DB::transaction(function () use ($request) {
            return $this->equipmentRepository->searchEquipment($request);
        });
    }

    /**
     * 新規備品を登録する
     *
     * @param    $data 備品登録リクエスト
     * @return Model 登録状況
     */
    public function createEquipment(array $data): Model
    {
        // 備品登録を行って、状況を返却する
        return DB::transaction(function () use ($data) {
            return $this->equipmentRepository
                ->create($data);
        });
    }

    /**
     * 備品情報を取得する
     *
     * @param    $EquipmentId 備品ID
     * @return ?Model 取得状況
     */
    public function getEquipmentById(int $equipmentId): ?Collection
    {
        // 備品情報を取得して返却する
        return DB::transaction(function () use ($equipmentId) {
            return $this->equipmentRepository
                ->getEquipmentById($equipmentId);
        });
    }

    

    /**
     * 住所情報を取得する
     *
     * @param    $employeeId 社員ID
     * @return ?Model 取得状況
     */
    public function getAddressList(): ?Collection
    {
        // 住所情報を取得して返却する
        return DB::transaction(function ()  {
            return $this->addressRepository
                ->getAll();
        });
    }

    /**
     * 備品情報を更新する
     *
     * @param    $data 備品登録リクエスト
     * @param    $EquipmentId 備品ID
     * @return ?Model 更新状況
     */
    public function updateEquipment(int $equipmentId, array $data): ?Model
    {
        // 担当者更新を行って、状況を返却する
        return DB::transaction(function () use ($equipmentId, $data) {
            return $this->equipmentRepository
                ->update($equipmentId, $data);
        });
    }

    /**
     * 備品情報を削除する
     *
     * @param    $EquipmentId 備品ID
     * @return bool 備品削除の状況
     */
    public function deleteEquipment(int $equipmentId): bool
    {
        // 担当者削除を行って、状況を返却する
        return DB::transaction(function () use ($equipmentId) {
            return $this->equipmentRepository
                ->deleteById($equipmentId);
        });
    }

    /**
     * 複数備品情報を削除する
     *
     * @param    $EquipmentIds 複数備品ID
     * @return bool 備品削除の状況
     */
    public function deleteMultiEquipment(array $equipmentIds): bool
    {
        // 備品削除を行って、状況を返却する
        return DB::transaction(function () use ($equipmentIds) {
            return $this->equipmentRepository
                ->deleteByIds($equipmentIds);
        });
    }
}
