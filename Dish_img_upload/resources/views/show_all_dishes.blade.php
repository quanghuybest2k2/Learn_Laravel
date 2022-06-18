<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Laravel 6 Advance CRUD </h1>
 <div class="float-right">
    <a href='/dishes/create' class='btn btn-primary'>Add New Dish</a>
 </div>
</div>
  
<div class="container">

@if(session()->has('status'))
  <div class="alert alert-success">
    {{session()->get('status')}}
  <button class="close" data-dismiss='alert'>X</button>
  </div>
@endif



<table class="table">
  <tr>
    <td>id</td>
    <td>Dish Name</td>
      <td>Dish Price</td>
      <td>Dish Description</td>
      <td>Dish Image</td>
      <td>Edit</td>
        <td>Delete</td>
  </tr>
 
@foreach($dishes as $d)
<tr>
    <td>{{$d->id}}</td>
    <td>{{$d->dish_name}}</td>
    <td>{{$d->dish_price}}</td>
    <td>{{$d->dish_description}}</td>
   
    <td>
    <img src="{{asset('uploaded_imgs')}}/{{$d->dish_image}}" height=100 width=100></td>
      <td><a href="dishes/{{$d->id}}/edit" class='btn btn-warning'>Edit</a></td>
        <td>
        <form action="dishes/{{$d->id}}" method='POST'>
        @csrf
        @method('DELETE')
        
          <input type="submit" value='delete' class='btn btn-delete'>
        </form>
        
        </td>
  </tr>
@endforeach

</table>
  
</div>

</body>
</html>
