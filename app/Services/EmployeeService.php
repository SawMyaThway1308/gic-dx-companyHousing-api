<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Traits\LogTrait;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * 社員ーサービス
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
class EmployeeService
{
    use LogTrait;

    private $employeeRepository;

    /**
     * コンストラクタ
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * 社員リストを取得する
     *
     * @return Collection メニューリスト
     */
    public function getAll(): Collection
    {
        // ログ出力する
        $this->infoLog(__FUNCTION__);
        return $this->employeeRepository->getAll();
    }

    /**
     * 対象社員リストを取得する
     *
     * @return Collection 担当者リスト
     */
    public function searchEmployee(Request $request): Collection
    {
        // 社員リストを取得して返却する
        return DB::transaction(function () use ($request) {
            return $this->employeeRepository->searchEmployee($request);
        });
    }

    /**
     * 新規社員を登録する
     *
     * @param    $data 社員登録リクエスト
     * @return Model 登録状況
     */
    public function createEmployee(array $data): Model
    {
        // 社員登録を行って、状況を返却する
        return DB::transaction(function () use ($data) {
            return $this->employeeRepository
                ->create($data);
        });
    }

    /**
     * 社員情報を取得する
     *
     * @param    $employeeId 社員ID
     * @return ?Model 取得状況
     */
    public function getEmployeeById(string $employeeId): ?Collection
    {
        // 社員情報を取得して返却する
        return DB::transaction(function () use ($employeeId) {
            return $this->employeeRepository
                ->getEmployeeById($employeeId);
        });
    }

    /**
     * 社員情報を更新する
     *
     * @param    $data 社員登録リクエスト
     * @param    $employeeId 社員ID
     * @return ?Model 更新状況
     */
    public function updateEmployee(string $employeeId, array $data): ?Model
    {
        // 担当者更新を行って、状況を返却する
        return DB::transaction(function () use ($employeeId, $data) {
            return $this->employeeRepository
                ->update($employeeId, $data);
        });
    }

    /**
     * 社員情報を削除する
     *
     * @param    $employeeId 社員ID
     * @return bool 社員削除の状況
     */
    public function deleteEmployee(string $employeeId): bool
    {
        // 担当者削除を行って、状況を返却する
        return DB::transaction(function () use ($employeeId) {
            return $this->employeeRepository
                ->deleteById($employeeId);
        });
    }

    /**
     * 複数社員情報を削除する
     *
     * @param    $employeeIds 複数社員ID
     * @return bool 社員削除の状況
     */
    public function deleteMultiEmployee(array $employeeIds): bool
    {
        // 社員削除を行って、状況を返却する
        return DB::transaction(function () use ($employeeIds) {
            return $this->employeeRepository
                ->deleteByIds($employeeIds);
        });
    }
}
