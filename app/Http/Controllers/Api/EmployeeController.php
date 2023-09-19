<?php

namespace App\Http\Controllers\Api;

use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeService;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Http\Request;

/**
 * 社員コントローラー
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */

class EmployeeController extends Controller
{
    use LogTrait;

    private $employeeService;

    /**
     * コンストラクタ
     */
    public function __construct(EmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }

    /**
     * 社員リストを取得する
     *
     * @return JsonResponse 担当者リスト
     */
    public function index(): JsonResponse
    {
        // 入力パラメターログ出力する
        $this->infoLog(__FUNCTION__);
        // 社員データを取得する
        $data = EmployeeResource::collection($this->employeeService->getAll());
        // 取得したデータをログ出力する
        $this->infoLog(__FUNCTION__, __('info_messages.print_output'), [$data]);
        // 社員リストを返却する
        return response()->success($data);
    }

    /**
     * 対象社員リストを取得する
     *
     * @return JsonResponse 社員リスト
     */
    public function search(Request $request): JsonResponse
    {
        // 対象担当者データを取得する
        $employeeList = EmployeeResource::collection(
            $this->employeeService->searchEmployee($request)
        );
        // 担当者リストを返却する
        return response()->success($employeeList);
    }

    /**
     * 新規社員を登録する
     *
     * @param    $request 社員登録リクエスト
     * @return JsonResponse 登録状況
     */
    public function store(EmployeeRequest $request): JsonResponse
    {
        // リクエストバリデーションを行う
        $data = $request->validated();

        // データ登録を行う
        if (isset($data)) {
            $this->employeeService->createEmployee($data);
        }
        // 登録状況を返却する
        return response()->successWithMsg(__('info_messages.insert_success'));
    }

    /**
     * 社員情報を取得する
     *
     * @param    $id 社員ID
     * @return JsonResponse 社員情報
     */
    public function edit(string $id): JsonResponse
    {
        // 社員情報をidで取得する
        $employee = EmployeeResource::collection($this->employeeService->getEmployeeById($id));
        // 対象する社員情報ある場合、データを返却する
        if ($employee) {
            return response()->success($employee);
        } else {
            return response()->error('ID '.$id.' での社員情報がないです。');
        }
    }

    /**
     * 社員情報を更新する
     *
     * @param    $request 社員登録リクエスト
     * @param    $id 社員ID
     * @return JsonResponse 更新状況
     */
    public function update(EmployeeUpdateRequest $request, string $id): JsonResponse
    {
        // リクエストバリデーションを行う
        $data = $request->validated();
        // 担当者を更新する
        $this->employeeService->updateEmployee($id, $data);
        // 更新状況を返却する
        return response()->successWithMsg(__('info_messages.update_success'));
    }

    /**
     * 社員情報を削除する
     *
     * @param    $id 社員ID
     * @return JsonResponse 社員削除の状況
     */
    public function destroy(string $id): JsonResponse
    {
        // 社員削除を行う
        $this->employeeService->deleteEmployee($id);
        // 削除状況を返却する
        return response()->successWithMsg(__('info_messages.delete_success'));
    }

    /**
     * 複数社員情報を削除する
     *
     * @param    $ids 複数社員ID
     * @return JsonResponse 社員削除の状況
     */
    public function deleteAll(Request $request): JsonResponse
    {
        // リクエストバリデーションを行う
        $employeeIds = $request->employee_id;
        // 社員削除を行う
        $this->employeeService->deleteMultiEmployee($employeeIds);
        // 削除状況を返却する
        return response()->successWithMsg(__('info_messages.delete_success'));
    }
}
