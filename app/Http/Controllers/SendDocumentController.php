<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendDocumentController extends Controller
{
    public function list()
    {
        switch (Auth::user()->role_id) {
            case 2: {
                    $where = [
                        ['status', 2],
                        ['user_id', Auth::user()->id]
                    ];
                    break;
                }
            case 3: {
                    $where = [
                        ['status', 3],
                        ['senior_id', Auth::user()->id]
                    ];
                    break;
                }
            case 4: {
                    $where = ['status', 4];
                    break;
                }
            case 5: {
                    $where = ['status', 5];
                    break;
                }
        }
        return Document::where($where)->with('products')->get();
    }
    public static $status = [
        2 => 3,
        3 => 4,
        4 => 5
    ];
    public function send(Request $request)
    {
        $this->updateStatus($request->id, self::$status[Auth::user()->role_id]);
        return response()->json(['success' => 'ok']);
    }
    public function updateStatus($id, $status)
    {
        $document = Document::findOrFail($id);
        $document->status = $status;
        $document->save();
    }
    public function unsend(Request $request)
    {
        $document = Document::findOrFail($request->id);
        $document->status = 0;
        $document->comment = $request->comment;
        $document->save();
        return response()->json(['success' => 'ok']);
    }
    public function abortList()
    {
        return Document::where('status',0)
        ->where('user_id',Auth::user()->id)
        ->with('products')->get();
    }
}
