<?php

namespace App\Repositories;

use App\Models\Address;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
 * 住所リポジトリ
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
class AddressRepository extends AbstractRepository
{
    /**
     * 関連のモデルを指定する
     */
    public function getModelClass(): string
    {
        return Address::class;
    }

    /**
     * 住所リストを取得する
     *
     * @return Collection データリスト
     */
    public function searchAddress(Request $request): Collection
    {
        $address = $request->address;

        // 対象項目を指定しない場合、全てのデータを取得する
        return $this->model
        ->when($address, function ($query) use ($address) {
            $query->where('address', 'LIKE', "%{$address}%");
        })->get();
    }

    /**
     * 住所リストを取得する
     *
     * @return Collection データリスト
     */
    public function getAddressById(string $addressId): ?Collection
    {
        // 対象項目を指定しない場合、全てのデータを取得する
        return $this->model->where('id', $addressId)->get();
    }
}
