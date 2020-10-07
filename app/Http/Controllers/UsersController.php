<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function users(Request $request){
        if(isset($_GET['sort'])){
            $sort=$_GET['sort'];
        }else{
            $sort='id';
        }
        $data=DB::table('users')->orderBy($sort)->simplePaginate(15);
        return view('users')->with('users', $data);
    }

    public function change(Request $request){
        $id=$request->get('id');
        $validatedata=$this->validate($request,[
            'name'=>'required|',
            'email'=>[
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'id'=>'required|exists:users,id'
        ]);
        $item=User::find($id);
        $result=$item->fill($validatedata)->save();

        if($result){
            return redirect()->back()->with(['success'=>'Данные успешно изменены']);
        }else{
            return back()->withErrors(['msg'=>'errors']);
        }
    }
    public function add(Request $request){

        $validatedata=$this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|unique:users,email',
            'password' => ['required', 'string', 'min:8'],
        ]);
        $result=User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        if($result){
            return redirect()->back()->with(['success'=>'Данные успешно изменены']);
        }else{
            return back()->withErrors(['msg'=>'errors']);
        }
    }
    public function search(Request $request){
        $q = $request->input('q');
        $data=[];
        $data1=['name','email'];
        for ($i=0; $i<$data1; $i++){
            try {
                $data=DB::table('users')->where($data1[$i],$q)->simplePaginate(15);
            }catch (\Exception $ex){
                return view('home')->with('books', $data);
            }
            if($data->count()!=0){
                return view('users')->with('users', $data);
            }
        }
    }
    public function filter(Request $request){
        $q = $request->input('q');
        $q1 = $request->input('q1');
        $data=[];
        if($q!='' && $q1!=''){
            $data=DB::table('users')->where('name',$q)->where('email',$q1)->simplePaginate(15);
            return view('users')->with('users', $data);
        }elseif ($q!=''){
            $data=DB::table('users')->where('name',$q)->paginate(15);
            return view('users')->with('users', $data);
        }elseif($q1!=''){
            $data=DB::table('users')->where('email',$q1)->paginate(15);
            return view('users')->with('users', $data);
        }else{
            $data=DB::table('users')->orderBy('id')->paginate(15);
            return view('users')->with('users', $data);
        }
    }
}
