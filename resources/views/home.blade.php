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
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col"><a href="?sort=id&page=<?=$page;?>">id</a></th>
            <th scope="col"><a href="?sort=name&page=<?=$page;?>">name</a></th>
            <th scope="col"><a href="?sort=author&page=<?=$page;?>">author</a></th>
            <th scope="col">description</th>
            <th scope="col">cover</th>
            <th scope="col"><a href="?sort=category&page=<?=$page;?>">category</a></th>
        </tr>
        </thead>
        <tbody>
      <?php if(!empty($books)){
      foreach ($books as $book):?>
      <?php $img='photos/'.$book->cover.'.jpg';?>
      <tr>
          <th><?php echo $book->id;?></th>
          <td><?php echo $book->name;?></td>
          <td><?php echo $book->author;?></td>
          <td><?php echo $book->description;?></td>
          <td><img src="<?=$img;?>" style="width: 50px; height: 70px;"/></td>
          <td><?php echo $book->category;?></td>
      </tr>
      <?php endforeach;
      }?>

        </tbody>

    </table>
<div>
<?php if(!empty($books)){ ?>
    {{ $books->appends(['sort'=>$url])->links() }}
    <?php }?>
</div>

@endsection
