<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Psr\Log\NullLogger;

class BooksController extends Controller
{
    public function change(Request $request){
        $cover=$request->file('cover');
        if($cover!=null){
            $filename=$request->file('cover')->getClientOriginalName();
            $cover = pathinfo($filename,PATHINFO_FILENAME);
            $request->file('cover')->move(public_path('photos'),$request->file('cover')->getClientOriginalName());
        }else{
            $cover=$request->post('cover_old');
        }

        $id=$request->get('id');
        if($request->post('delete')=='delete'){
            $item=Books::find($id);
            $result=$item->delete();
        }else{
            $validatedata=$this->validate($request,[
                'name'=>'required|',
                'author'=>'required|',
                'description'=>'required|',
                'category'=>'required|',
                'id'=>'required|exists:books,id'
            ]);
            $item=Books::find($id);
            $item->cover=$cover;
            $result=$item->fill($validatedata)->save();
        }
        if($result){
            return redirect()->back()->with(['success'=>'Данные успешно изменены']);
        }else{
            return back()->withErrors(['msg'=>'errors']);
        }

    }
}
