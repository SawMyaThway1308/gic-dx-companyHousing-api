<?php

namespace App\Repositories;

use App\Models\Test;
use Illuminate\Support\Collection;

/**
 * メッセージリポジトリ
 *
 * 作成者: ウェイ
 * 作成日: 2022.12.05
 */
class TestRepository extends AbstractRepository
{
    /**
     * 関連のモデルを指定する
     */
    public function getModelClass(): string
    {
        return Test::class;
    }

    public function getAll(): Collection
    {
        // 対象項目を指定しない場合、全てのデータを取得する。その他、該当の項目のみ取得する
        return $this->model->get();
    }
}
