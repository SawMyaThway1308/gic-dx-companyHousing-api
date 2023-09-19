<?php

namespace App\Services;

use App\Repositories\TestRepository;
use App\Traits\LogTrait;
use Illuminate\Support\Collection;

/**
 * メニューサービス
 *
 * 作成者: ウェイ
 * 作成日: 2022.12.02
 */
class TestService
{
    use LogTrait;

    private $testRepository;

    /**
     * コンストラクタ
     */
    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    /**
     * メニューリストを取得する
     *
     * @return Collection メニューリスト
     */
    public function getAll(): Collection
    {
        // ログ出力する
        $this->infoLog(__FUNCTION__);
        return $this->testRepository->getAll();
    }
}
