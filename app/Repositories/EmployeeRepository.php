<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

/**
 * 社員リポジトリ
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */
class EmployeeRepository extends AbstractRepository
{
    /**
     * 関連のモデルを指定する
     */
    public function getModelClass(): string
    {
        return Employee::class;
    }

    /**
     * 社員リストを取得する
     *
     * @return Collection データリスト
     */
    public function searchEmployee(Request $request): Collection
    {
        $employeeId = $request->employee_id;
        $employeeName = $request->employee_name;

        // 対象項目を指定しない場合、全てのデータを取得する
        return $this->model
        ->when($employeeId, function ($query) use ($employeeId) {
            $query->where('employee_id', 'LIKE', "%{$employeeId}%");
        })
        ->when($employeeName, function ($query) use ($employeeName) {
            $query->where('employee_name', 'LIKE', "%{$employeeName}%");
        })->get();
    }

    /**
     * 社員リストを取得する
     *
     * @return Collection データリスト
     */
    public function getEmployeeById(string $employeeId): ?Collection
    {
        // 対象項目を指定しない場合、全てのデータを取得する
        return $this->model->where('employee_id', $employeeId)->get();
    }
}
