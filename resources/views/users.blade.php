@extends('layout')
@section('container')
    <?php if(isset($_GET['sort'])){
        $url=$_GET['sort'];
    }else{
        $url='id';
    }?>
    <?php if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page='0';
    }?>
    @php
    /**@var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session()->get('success') }}</li>
            </ul>
        </div>
    @endif
    <form action="/search_user" method="GET" class="search-simple" style="float: right;margin-right: 20px;">
        <div class="row">
            <div class="col-xs-10">
                <div class="form-group">
                    <input type="text" class="form-control" name="q" value="{{ old('q') }}" required>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <input class="btn btn-info" type="submit" value="Искать">
                </div>
            </div>
        </div>
    </form>
    <form action="/filter_user" method="GET" class="filter-simple" style="float: left;margin-left: 20px;">
        <div class="row">
            <div class="col-xs-10">
                <div class="form-inline">
                    <span style="margin-left: 5px;">Выбрать пользователя по имени</span>
                    <input type="text" class="form-control" name="q" value="{{ old('q') }}" style="margin-left: 5px;">
                    <span style="margin-left: 5px;">Выбрать пользователя по email</span>
                    <input type="text" class="form-control" name="q1" value="{{ old('q1') }}" style="margin-left: 5px;">
                </div>
            </div>
            <div class="col-xs-2">
                <div class="form-group">
                    <input class="btn btn-info" type="submit" value="применить фильтры">
                </div>
            </div>
        </div>
    </form>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col"><a href="?sort=id&page=">id</a></th>
        <th scope="col"><a href="?sort=name&page=">name</a></th>
        <th scope="col"><a href="?sort=email&page=">email</a></th>
        <th scope="col"><a href="?sort=email_verified_at&page=">verified</a></th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($users)){
    foreach ($users as $user):?>
    <tr>
        <th><a href="?id={{$user->id}}"><?php echo $user->id;?></a></th>
        <td><?php echo $user->name;?></td>
        <td><?php echo $user->email;?></td>
        <td><?php if($user->email_verified_at!=null) {echo 'email verified';}else{echo 'email not verified';};?></td>
    </tr>
    <?php endforeach;
    }?>

    </tbody>

</table>
    <?php if(!empty($users)){ ?>
    {{ $users->appends(['sort'=>$url])->links() }}
    <?php }?>
<?php
    $name1='';
    $email1='';
    $id='';
    foreach ($users as $user){
        if($user->id==request()->get('id')){
            $name1=$user->name;
            $email1=$user->email;
            $id=$user->id;
        }
    }
?>
<hr>
    <div class="row">
        <div class="col-sm-6">
            <label id="lbl_usr">Изменить текущего пользователя</label>
            <form id="mymodal" action="/change" method="post" >
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$id}}">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$email1}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">name</label>
                    <input type="text"  name="name" class="form-control" id="exampleInputPassword1" value="{{$name1}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-sm-6">
            <label id="lbl_usr">создать нового пользователя</label>
            <form id="mymodal" action="/add" method="post" >
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">name</label>
                    <input type="text"  name="name" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">password</label>
                    <input type="password"  name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection
