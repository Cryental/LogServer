<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    public function CreateLog(Request $request, $id)
    {
        if (!$request->isJson()) {
            return response()->json([
                'error' => 'Please try again with JSON content type.'
            ], 403);
        }

        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $validator = Validator::make(array_merge($request->all(), [
            'id' => $id
        ]), [
            'id' => ['bail', 'required', 'integer'],
            'log_text' => ['bail', 'required', 'string', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 400);
        }

        $channel = Channel::query()->find($id);

        if (!$channel) {
            return response()->json([
                'error' => 'Channel not found.'
            ], 404);
        }

        $log = Log::query()->create([
            'channel_id' => $id,
            'log_text' => $request->input('log_text')
        ]);

        return response()->json($log->fresh());
    }

    public function GetLogs(Request $request, $id)
    {
        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $validator = Validator::make([
            'channel id' => $id
        ], [
            'channel id' => ['bail', 'required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 403);
        }

        $channel = Channel::query()->find($id);

        if (!$channel) {
            return response()->json([
                'error' => 'Channel not found.'
            ], 404);
        }

        $logs = Log::query()->where('channel_id', $id)->get();

        return response()->json($logs);
    }

    public function GetLog(Request $request, $id, $log_id)
    {
        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $validator = Validator::make([
            'id' => $id,
            'log_id' => $log_id
        ], [
            'id' => ['bail', 'required', 'integer'],
            'log_id' => ['bail', 'required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 400);
        }

        $channel = Channel::query()->find($id);

        if (!$channel) {
            return response()->json([
                'error' => 'Channel not found.'
            ], 404);
        }

        $log = Log::query()->where('id', $log_id)->where('channel_id', $id)->first();

        if (!$log) {
            return response()->json([
                'error' => 'Log not found.'
            ], 404);
        }

        return response()->json($log);
    }

    public function DeleteLog(Request $request, $id, $log_id)
    {
        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $validator = Validator::make([
            'id' => $id,
            'log_id' => $log_id
        ], [
            'id' => ['bail', 'required', 'integer'],
            'log_id' => ['bail', 'required', 'integer']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 400);
        }

        $channel = Channel::query()->find($id);

        if (!$channel) {
            return response()->json([
                'error' => 'Channel not found.'
            ], 404);
        }

        $log = Log::query()->where('id', $log_id)->where('channel_id', $id)->first();

        if (!$log) {
            return response()->json([
                'error' => 'Log not found.'
            ], 404);
        }

        $log->delete();

        return response('', 204);
    }
}
