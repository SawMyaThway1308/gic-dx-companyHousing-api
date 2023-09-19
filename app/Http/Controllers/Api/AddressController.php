<?php

namespace App\Http\Controllers\Api;

use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AddressResource;
use App\Services\AddressService;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddressUpdateRequest;
use Illuminate\Http\Request;

/**
 * 住所コントローラー
 *
 * 作成者: ソー
 * 作成日: 2023.09.14
 */

class AddressController extends Controller
{
    use LogTrait;

    private $addressService;

    /**
     * コンストラクタ
     */
    public function __construct(AddressService $addressService) {
        $this->addressService = $addressService;
    }

    /**
     * 住所リストを取得する
     *
     * @return JsonResponse 住所リスト
     */
    public function index(): JsonResponse
    {
        // 入力パラメターログ出力する
        $this->infoLog(__FUNCTION__);
        // 住所データを取得する
        $data = AddressResource::collection($this->addressService->getAll());
        // 取得したデータをログ出力する
        $this->infoLog(__FUNCTION__, __('info_messages.print_output'), [$data]);
        // 住所リストを返却する
        return response()->success($data);
    }
    
    /**
     * 対象住所リストを取得する
     *
     * @return JsonResponse 住所リスト
     */
    public function search(Request $request): JsonResponse
    {
        // 対象担当者データを取得する
        $addressList = AddressResource::collection(
            $this->addressService->searchAddress($request)
        );
        // 担当者リストを返却する
        return response()->success($addressList);
    }

    /**
     * 新規住所を登録する
     *
     * @param    $request 住所登録リクエスト
     * @return JsonResponse 登録状況
     */
    public function store(AddressRequest $request): JsonResponse
    {
        // リクエストバリデーションを行う
        $data = $request->validated();

        // データ登録を行う
        if (isset($data)) {
            $this->addressService->createAddress($data);
        }
        // 登録状況を返却する
        return response()->successWithMsg(__('info_messages.insert_success'));
    }

    /**
     * 住所情報を取得する
     *
     * @param    $id 住所ID
     * @return JsonResponse 住所情報
     */
    public function edit(int $id): JsonResponse
    {
        // 住所情報をidで取得する
        $address = AddressResource::collection(
            $this->addressService->getAddressById($id)
        );
        // 対象する住所情報ある場合、データを返却する
        if ($address) {
            return response()->success($address);
        } else {
            return response()->error('ID '.$id.' での住所情報がないです。');
        }
    }

    /**
     * 住所情報を更新する
     *
     * @param    $request 住所登録リクエスト
     * @param    $id 住所ID
     * @return JsonResponse 更新状況
     */
    public function update(AddressUpdateRequest $request, int $id): JsonResponse
    {
        // リクエストバリデーションを行う
        $data = $request->validated();
        // 担当者を更新する
        $this->addressService->updateAddress($id, $data);
        // 更新状況を返却する
        return response()->successWithMsg(__('info_messages.update_success'));
    }

    /**
     * 住所情報を削除する
     *
     * @param    $id 住所ID
     * @return JsonResponse 住所削除の状況
     */
    public function destroy(int $id): JsonResponse
    {
        // 住所削除を行う
        $this->addressService->deleteAddress($id);
        // 削除状況を返却する
        return response()->successWithMsg(__('info_messages.delete_success'));
    }

    /**
     * 複数住所情報を削除する
     *
     * @param    $ids 複数住所ID
     * @return JsonResponse 住所削除の状況
     */
    public function deleteAll(Request $request): JsonResponse
    {
        // リクエストバリデーションを行う
        $addressIds = $request->address_id;
        // 住所削除を行う
        $this->addressService->deleteMultiAddress($addressIds);
        // 削除状況を返却する
        return response()->successWithMsg(__('info_messages.delete_success'));
    }
}
