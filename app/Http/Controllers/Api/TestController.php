<?php

namespace App\Http\Controllers\Api;

use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TestResource;
use App\Services\TestService;

class TestController extends Controller
{
    use LogTrait;

    private $testService;

    public function __construct(TestService $testService) {
        $this->testService = $testService;
    }

    public function index(): JsonResponse
    {
        // 入力パラメターログ出力する
        $this->infoLog(__FUNCTION__);
        //
        $data = TestResource::collection($this->testService->getAll());
        //
        $this->infoLog(__FUNCTION__, __('info_messages.print_output'), [$data]);
        // 
        return response()->success($data);
    }

}
