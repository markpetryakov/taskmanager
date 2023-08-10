<title>Edit List</title>
@include ("header")

<div class="container">
    <h4 style="text-align: center;">Edit List</h4>
    <form action="{{route('editList.post', $tasklist->id)}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
@csrf
@method('PUT')
<input type="hidden" name="owner" value="{{auth()->user()->id}}">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="{{$tasklist->title}}">

  </div>
  
  <div class="mt-3" >
        @if($errors->any())
        <div class="col-12">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
  <button type="submit" class="btn btn-primary">Save List</button>
  <a href="{{route('lists')}}" class="btn btn-info">Back to Lists</a>
</form>

</div>
