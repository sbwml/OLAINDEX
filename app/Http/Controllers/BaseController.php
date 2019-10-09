<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BaseController extends Controller
{
    /**
     * 数据返回
     * @param mixed $data
     * @param int $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnData($data, $code = 200, $message = 'ok')
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * 抛出字段验证异常
     * @param $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorBadRequest($validator)
    {
        $result = [];
        /* @var $validator \Illuminate\Validation\Validator */
        $messages = $validator->errors()->toArray();
        if ($messages) {
            foreach ($messages as $field => $errors) {
                foreach ($errors as $error) {
                    $result[] = [
                        'field' => $field,
                        'code' => $error,
                    ];
                }
            }
        }
        return $this->returnData($result, 400, '出现错误了');
    }

    /**
     * 数组分页
     * @param array $items
     * @param int $perPage
     * @return array
     */
    public function paginate($items = [], $perPage = 10)
    {
        $pageStart = request()->get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
        $data = new LengthAwarePaginator(
            $itemsForCurrentPage,
            count($items),
            $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
        return $data->toArray();
    }

}
