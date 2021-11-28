<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Message;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $message = Message::paginate(10);
        return view('admin.message', compact('message'));
    }
    public function view($id)
    {
        $message = Message::find($id);
        return view('admin.showmessage', compact('message'));
    }
    public function delete($id)
    {
        $message = Message::find($id)->delete();
        return redirect()->route('admin.message')->with('success','Message deleted successfully');
    }
}
