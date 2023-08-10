<title>Delete List</title>
@include ("header")

<div class="container" style="width: 400px">

    <h3 style="text-align: center;">Delete List "{{$tasklist->title}}"?</h3><br>
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
          
      <form action="{{route('destroyListpost', $tasklist->id)}}" method="post" class="mx-auto me-auto mt-3" >
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger position-absolute top-44 start-50 translate-middle" >Delete List</button><br><br>
    <a href="{{route('lists')}}" class="btn btn-info position-absolute top-44 start-50 translate-middle">Back to Lists</a>
    </form>
    </div>
</div>