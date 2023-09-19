<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use App\Traits\LogTrait;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * 住所ーサービス
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
class AddressService
{
    use LogTrait;

    private $addressRepository;

    /**
     * コンストラクタ
     */
    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * 住所リストを取得する
     *
     * @return Collection メニューリスト
     */
    public function getAll(): Collection
    {
        // ログ出力する
        $this->infoLog(__FUNCTION__);
        return $this->addressRepository->getAll();
    }

    /**
     * 対象住所リストを取得する
     *
     * @return Collection 担当者リスト
     */
    public function searchAddress(Request $request): Collection
    {
        // 住所リストを取得して返却する
        return DB::transaction(function () use ($request) {
            return $this->addressRepository->searchAddress($request);
        });
    }

    /**
     * 新規住所を登録する
     *
     * @param    $data 住所登録リクエスト
     * @return Model 登録状況
     */
    public function createAddress(array $data): Model
    {
        // 住所登録を行って、状況を返却する
        return DB::transaction(function () use ($data) {
            return $this->addressRepository
                ->create($data);
        });
    }

    /**
     * 住所情報を取得する
     *
     * @param    $addressId 住所ID
     * @return ?Model 取得状況
     */
    public function getAddressById(int $addressId): ?Collection
    {
        // 住所情報を取得して返却する
        return DB::transaction(function () use ($addressId) {
            return $this->addressRepository
                ->getAddressById($addressId);
        });
    }

    /**
     * 住所情報を更新する
     *
     * @param    $data 住所登録リクエスト
     * @param    $addressId 住所ID
     * @return ?Model 更新状況
     */
    public function updateAddress(int $addressId, array $data): ?Model
    {
        // 担当者更新を行って、状況を返却する
        return DB::transaction(function () use ($addressId, $data) {
            return $this->addressRepository
                ->update($addressId, $data);
        });
    }

    /**
     * 住所情報を削除する
     *
     * @param    $addressId 住所ID
     * @return bool 住所削除の状況
     */
    public function deleteAddress(int $addressId): bool
    {
        // 担当者削除を行って、状況を返却する
        return DB::transaction(function () use ($addressId) {
            return $this->addressRepository
                ->deleteById($addressId);
        });
    }

    /**
     * 複数住所情報を削除する
     *
     * @param    $addressIds 複数住所ID
     * @return bool 住所削除の状況
     */
    public function deleteMultiAddress(array $addressIds): bool
    {
        // 住所削除を行って、状況を返却する
        return DB::transaction(function () use ($addressIds) {
            return $this->addressRepository
                ->deleteByIds($addressIds);
        });
    }
}
