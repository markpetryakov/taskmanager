@include('header')
<title>My Lists</title>
<br>
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
@if ($owner == 0)
<img src="{{URL('/images/task.jpg')}}" alt="task" width="1300px">
@endif
@auth
<div class="container pb-8" style="width: 1000px;">
<div class="float-start">
    <h4 class="pb-3">My Lists</h4>
</div>
<div class="float-end">
    <a href="{{route('createList')}}" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Create List</a>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New List</h1>

       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{route('createList.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
        @csrf
        <input type="hidden" name="owner" value="{{auth()->user()->id}}">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" style="width:470px" name="title">

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
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create List</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

@foreach($tasklists as $tasklist)

@if($tasklist->owner == $owner)


<div class="card">

    <div class="card-header bg-info">
        <h3>{{$tasklist->title}}</h3>

    </div>
    

    <div class="card-body bg-info-subtle">
        <div class="card-text">
        <div class="float-start fs-4">
            Tasks:<br>
        @foreach($tasks as $task)
        @if($tasklist->id == $task->listId)
        <span class="fs-6">{{$task->title}}</span><br>
        @endif
        @endforeach
</div>
<div class="float-end">
    <a href="{{route('list', $tasklist->id)}}" class="btn btn-primary">View List</a><br><br>
    <a href="{{route('editList', $tasklist->id)}}" class="btn btn-warning">Edit List</a><br><br>
    <a href="{{route('destroyList', $tasklist->id)}}" class="btn btn-danger">Delete List</a><br><br>
   
</div>
<div class="clearfix"></div>
        
    </div>
    </div>
</div>
<br>

@endif
@endforeach

</div>
@endauth