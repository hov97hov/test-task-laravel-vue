<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getAllMessages(): JsonResponse
    {
        return response()->json([
            'allMessages' => Message::where(['user_id' => '1', 'archived' => '1'])->get()
        ]);
    }

    public function addArchiveMessage(Request $request)
    {
        return Message::where('id', $request->id)->update([
            'archived' => $request->archived
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getArchiveMessages(): JsonResponse
    {
        return response()->json([
            'archiveMessages' => Message::where(['user_id' => '1', 'archived' => '0'])->get()
        ]);
    }

    public function deleteMessage(Request $request)
    {
        return Message::where('id', $request->id)->delete();
    }

    public function getOneMessage(Request $request)
    {
        dd($request->all());
        return response()->json([
            'oneMessage' => Message::where('id', $request->id)->first()
        ]);
    }
}
