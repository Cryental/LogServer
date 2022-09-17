<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
    public function CreateChannel(Request $request)
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

        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'string', 'min:3', 'max:255', 'unique:channels,name'],
            'description' => ['bail', 'required', 'string', 'min:3', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 400);
        }

        $channel = Channel::query()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return response()->json($channel->fresh());
    }

    public function GetChannels(Request $request)
    {
        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $channels = Channel::query()->get();

        return response()->json($channels);
    }

    public function GetChannel(Request $request, $id)
    {
        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $validator = Validator::make([
            'id' => $id
        ], [
            'id' => ['bail', 'required', 'integer']
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

        return response()->json($channel);
    }

    public function DeleteChannel(Request $request, $id)
    {
        if (!$this->checkToken($request->bearerToken())) {
            return response()->json([
                'error' => 'The token is invalid or blocked.'
            ], 403);
        }

        $validator = Validator::make([
            'id' => $id
        ], [
            'id' => ['bail', 'required', 'integer']
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

        $channel->delete();

        return response('', 204);
    }
}
