<?php


namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;

class Msg
{
    /**
     * @param  string  $msg
     * @return JsonResponse
     */
    public static function ok(string $msg = 'ok'): JsonResponse
    {
        return response()->json([
            'code' => 0,
            'msg'  => $msg,
            'data' => new \stdClass(),
        ]);
    }

    /**
     * @param  array  $data
     * @param  string  $msg
     * @param  int  $code
     * @return JsonResponse
     */
    public static function success(array $data = [], string $msg = 'ok', int $code = 0): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => empty($data) ? new \stdClass() : $data,
        ]);
    }

    /**
     * @param  int  $code
     * @param  string  $msg
     * @param  array  $data
     * @return JsonResponse
     */
    public static function error(string $msg = 'undefined error', int $code = 1, array $data = []): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => empty($data) ? new \stdClass() : $data,
        ]);
    }


    /**
     * @param  int  $code
     * @param  string  $msg
     * @param  array  $data
     * @return JsonResponse
     */
    public static function code(int $code = 0, string $msg = 'undefined error', array $data = []): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'msg'  => $msg,
            'data' => empty($data) ? new \stdClass() : $data,
        ]);
    }
}