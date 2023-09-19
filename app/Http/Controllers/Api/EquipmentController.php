<?php

namespace App\Http\Controllers\Api;

use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\EquipmentAddressResource;
use App\Services\equipmentService;
use App\Http\Requests\EquipmentRequest;
use App\Http\Requests\EquipmentUpdateRequest;
use Illuminate\Http\Request;

/**
 * 備品コントローラー
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */

class EquipmentController extends Controller
{
    use LogTrait;

    private $equipmentService;

    /**
     * コンストラクタ
     */
    public function __construct(equipmentService $equipmentService) {
        $this->equipmentService = $equipmentService;
    }

    /**
     * 備品リストを取得する
     *
     * @return JsonResponse 担当者リスト
     */
    public function index(): JsonResponse
    {
        // 入力パラメターログ出力する
        $this->infoLog(__FUNCTION__);
        // 備品データを取得する
        $data = EquipmentResource::collection($this->equipmentService->getAll());
        // 住所リストを取得する
        $address = EquipmentAddressResource::collection($this->equipmentService->getAddressList());
        // 取得したデータをログ出力する
        $this->infoLog(__FUNCTION__, __('info_messages.print_output'), [$data, $address]);
        // 備品リストを返却する
        return response()->success([
            "equipments" => $data,
            "address" => $address
        ]);
    }

    /**
     * 対象備品リストを取得する
     *
     * @return JsonResponse 備品リスト
     */
    public function search(Request $request): JsonResponse
    {
        // 対象担当者データを取得する
        $equipmentList = EquipmentResource::collection(
            $this->equipmentService->searchEquipment($request)
        );
        // 担当者リストを返却する
        return response()->success($equipmentList);
    }

    /**
     * 新規備品を登録する
     *
     * @param    $request 備品登録リクエスト
     * @return JsonResponse 登録状況
     */
    public function store(EquipmentRequest $request): JsonResponse
    {
        // リクエストバリデーションを行う
        $data = $request->validated();

        // データ登録を行う
        if (isset($data)) {
            $this->equipmentService->createEquipment($data);
        }
        // 登録状況を返却する
        return response()->successWithMsg(__('info_messages.insert_success'));
    }

    /**
     * 備品情報を取得する
     *
     * @param    $id 備品ID
     * @return JsonResponse 備品情報
     */
    public function edit(int $id): JsonResponse
    {
        // 備品情報をidで取得する
        $equipment = EquipmentResource::collection($this->equipmentService->getEquipmentById($id));
        // 対象する備品情報ある場合、データを返却する
        if ($equipment) {
            return response()->success($equipment);
        } else {
            return response()->error('ID '.$id.' での備品情報がないです。');
        }
    }

    /**
     * 備品情報を更新する
     *
     * @param    $request 備品登録リクエスト
     * @param    $id 備品ID
     * @return JsonResponse 更新状況
     */
    public function update(EquipmentUpdateRequest $request, int $id): JsonResponse
    {
        // リクエストバリデーションを行う
        $data = $request->validated();
        // 担当者を更新する
        $this->equipmentService->updateEquipment($id, $data);
        // 更新状況を返却する
        return response()->successWithMsg(__('info_messages.update_success'));
    }

    /**
     * 備品情報を削除する
     *
     * @param    $id 備品ID
     * @return JsonResponse 備品削除の状況
     */
    public function destroy(int $id): JsonResponse
    {
        // 備品削除を行う
        $this->equipmentService->deleteEquipment($id);
        // 削除状況を返却する
        return response()->successWithMsg(__('info_messages.delete_success'));
    }

    /**
     * 複数備品情報を削除する
     *
     * @param    $ids 複数備品ID
     * @return JsonResponse 備品削除の状況
     */
    public function deleteAll(Request $request): JsonResponse
    {
        // リクエストバリデーションを行う
        $equipmentIds = $request->equipment_id;
        // 備品削除を行う
        $this->equipmentService->deleteMultiEquipment($equipmentIds);
        // 削除状況を返却する
        return response()->successWithMsg(__('info_messages.delete_success'));
    }
}
