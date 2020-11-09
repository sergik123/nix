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

<form action="/search" method="GET" class="search-simple" style="float: right;margin-right: 20px;">
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
<form action="/filter" method="GET" class="filter-simple" style="float: left;margin-left: 20px;">
    <div class="row">
        <div class="col-xs-10">
            <div class="form-inline">
                <span style="margin-left: 5px;">Выбрать автора</span>
                <input type="text" class="form-control" name="q" value="{{ old('q') }}" style="margin-left: 5px;">
                <span style="margin-left: 5px;">Выбрать категорию</span>
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
@role('admin')
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
@endrole
<div id="app">
    <table-component></table-component>
    <router-view></router-view>
</div>
<?php
$id='';
$name='';
$author='';
$descr='';
$cover='';
$category='';
foreach ($books as $book){
    if($book->id==request()->get('id')){
        $name=$book->name;
        $author=$book->author;
        $descr=$book->description;
        $cover=$book->cover;
        $category=$book->category;
        $id=$book->id;
    }
}
?>
@role('admin')
<hr>
<div class="row">
    <div class="col-sm-6" style="border: 1px solid black;">
        <label id="lbl_usr">Изменить книгу</label>
        <form enctype="multipart/form-data" id="mymodal" action="/changebook" method="post" >
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="cover_old" value="{{$cover}}">
                <label for="exampleInputEmail1">Name</label>
                <input type="text"  name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">author</label>
                <input type="text"  name="author" class="form-control" id="exampleInputPassword1" value="{{$author}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">description</label>
                <input type="text"  name="description" class="form-control" id="exampleInputPassword1" value="{{$descr}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">cover</label>
                <input type="file"  accept="image/jpeg" name="cover" class="form-control" id="exampleInputPassword1" value="{{$cover}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">category</label>
                <input type="text"  name="category" class="form-control" id="exampleInputPassword1" value="{{$category}}">
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>

            <button type="submit" name="delete" class="btn btn-primary" value="delete" style="float: right;">Удалить</button>
        </form>
    </div>

    <div class="col-sm-6" style="border: 1px solid black;">
        <label id="lbl_usr">создание новой книги</label>
        <form enctype="multipart/form-data" id="mymodal" action="/addbook" method="post" >
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text"  name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">author</label>
                <input type="text"  name="author" class="form-control" id="exampleInputPassword1" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">description</label>
                <input type="text"  name="description" class="form-control" id="exampleInputPassword1" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">cover</label>
                <input type="file"  accept="image/jpeg" name="cover" class="form-control" id="exampleInputPassword1" >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">category</label>
                <input type="text"  name="category" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
@endrole

<script src="./js/app.js"></script>

@endsection





