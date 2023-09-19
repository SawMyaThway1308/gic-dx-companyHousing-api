<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;

/**
 * リポジトリ
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
abstract class AbstractRepository
{
    protected $model;

    protected $modelClass;

    public const DESC = 'DESC';

    public const ASC = 'ASC';

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * エクステンドする各クラスに実装される抽象メソッド
     *
     * @return string 対象モデル名
     */
    abstract public function getModelClass(): string;

    /**
     * 対象モデルを指定する
     */
    private function setModel(): void
    {
        $this->model = app()->make($this->getModelClass());
    }

    /**
     * 対象モデルのIdを取得する
     *
     * @return string 対象モデルのId
     */
    public function getKeyName(): string
    {
        return $this->model->getKeyName();
    }

    /**
     * 更新可能の項目名を取得する
     *
     * @return array
     */
    public function getFillable(): array
    {
        return $this->model->getFillable();
    }

    /**
     * 該当テーブルの項目名を取得する
     *
     * @return array テーブル名
     */
    public function getColumns(): array
    {
        return Schema::getColumnListing($this->getTableName());
    }

    /**
     * テーブル名を取得する
     *
     * @return string テーブル名
     */
    public function getTableName(): string
    {
        return $this->model->getTable();
    }

    /**
     * データリストを取得する
     *
     * @return Collection データリスト
     */
    public function getAll(): Collection
    {
        // 対象項目を指定しない場合、全てのデータを取得する。その他、該当の項目のみ取得する
        return $this->model->get();
    }

    /**
     * 渡されたIdで対象のデータを取得する
     *
     * @param $id id
     * @param $selects 取得対象の項目
     * @return ?Model モダルデータ
     */
    public function find($id, array $selects = []): ?Model
    {
        // 対象項目を指定しない場合、全てのデータを取得する。その他、該当の項目のみ取得する
        return $this->model
            ->when($selects, function ($query) use ($selects) {
                $query->select($selects);
            })
            ->find($id);
    }

    /**
     * 最大Idを取得する
     *
     * @return int 最大Id
     */
    public function findMax(): ?int
    {
        $id = $this->model->max($this->model->getKeyName());
        if (is_null($id)) {
            return 0;
        }

        return $id;
    }

    /**
     * データを登録する
     *
     * @param $data 登録対象データ
     * @return ?Model モダルデータ
     */
    public function create(array $data): Model
    {
        // 対象テーブルに登録
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    /**
     * データを登録する
     *
     * @param $data 登録対象データ
     * @return ?Model モダルデータ
     */
    public function add(array $data): ?Model
    {
        // 対象テーブルに登録する
        return DB::transaction(function () use ($data) {
            $this->model
                ->fill($data)
                ->save();

            return $this->model;
        });
    }

    /**
     * 複数のデータを一括登録する
     *
     * @param $data 登録対象データ
     * @return ?Model モダルデータ
     */
    public function bulkInsert(array $data): bool
    {
        // 対象テーブルに登録
        return DB::transaction(function () use ($data) {
            return $this->model->insert($data);
        });
    }

    /**
     * データを更新する
     *
     * @param $id 更新対象Id
     * @param $data 更新対象データ
     * @return ?Model モダルデータ
     */
    public function update($id, array $data): ?Model
    {
        // 対象Idで更新対象データを取得する
        $target = $this->find($id);
        if (is_null($target)) {
            return null;
        }

        // 対象テーブルに更新する
        return DB::transaction(function () use ($target, $data) {
            $target
                ->fill($data)
                ->save();

            return $target;
        });
    }

    /**
     * データを削除する
     *
     * @param $id 削除対象Id
     * @return ?bool 削除処理成功又は失敗の結果
     */
    public function deleteById($id): bool
    {
        // 対象Idで削除対象データを取得する
        $target = $this->find($id);
        if (is_null($target)) {
            return false;
        }

        // 対象レコードを削除する
        return DB::transaction(function () use ($target) {
            return $target->delete();
        });
    }

    /**
     * データを削除する
     *
     * @param ids 削除対象Id配列
     * @return ?bool 削除処理成功又は失敗の結果
     */
    public function deleteByIds(array $ids): bool
    {
        // 対象レコードを削除する
        return DB::transaction(function () use ($ids) {
            return $this->model
                ->whereIn($this->getKeyName(), $ids)
                ->delete();
        });
    }

    /**
     * 対象モダルの全ての行を削除する
     */
    public function truncate(): void
    {
        // 対象モダルの全ての行を削除する
        $this->model->truncate();
    }
}
