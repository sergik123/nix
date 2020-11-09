<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function main(){
        if(isset($_GET['sort'])){
            $sort=$_GET['sort'];

        }else{
            $sort='id';
        }
        $data=DB::table('books')->orderBy($sort)->Paginate(15);
        return view('home')->with('books', $data);
    }
    public function search(Request $request){
        $q = $request->input('q');
        $data=[];
        $data1=['name','author','description','category'];
        for ($i=0; $i<$data1; $i++){
            try {
                $data=DB::table('books')->where($data1[$i],$q)->simplePaginate(15);
            }catch (\Exception $ex){
                return view('home')->with('books', $data);
            }
            if($data->count()!=0){
                return view('search')->with('books', $data);
            }
        }
    }
    public function filter(Request $request){
        $q = $request->input('q');
        $q1 = $request->input('q1');
        $data=[];
        if($q!='' && $q1!=''){
            $data=DB::table('books')->where('author',$q)->where('category',$q1)->simplePaginate(15);
            return view('search')->with('books', $data);
        }elseif ($q!=''){
            $data=DB::table('books')->where('author',$q)->paginate(15);
            return view('search')->with('books', $data);
        }elseif($q1!=''){
            $data=DB::table('books')->where('category',$q1)->paginate(15);
            return view('search')->with('books', $data);
        }else{
            $data=DB::table('books')->orderBy('id')->paginate(15);
            return view('search')->with('books', $data);
        }
    }

}
