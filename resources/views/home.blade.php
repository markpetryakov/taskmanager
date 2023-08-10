@include('header')
<title>My Tasks</title>
<br><br>
@auth
<div class="container pb-8" style="width: 1000px;">
<h3 class="p-3 text-primary-emphasis text-center bg-primary-subtle border border-primary-subtle rounded-3">{{$tasklist->title}}</h3>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">My Tasks</a>
   
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link dropdown-toggle"  style="margin-left: 15px;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          
          Sort by
          
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'status'])}}" >Status</a></li>
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'date'])}}" >Due Date</a></li>
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'priority'])}}" >Priority</a></li>
            
          </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link dropdown-toggle"  style="margin-left: 15px;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          
          Filter by Status
          
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'ToDo'])}}" >ToDo</a></li>
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'Done'])}}" >Done</a></li>
           
            
          </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link dropdown-toggle"  style="margin-left: 15px;" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          
        Filter by Priority
          
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'High'])}}" >High</a></li>
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'Medium'])}}" >Medium</a></li>
            <li><a class="dropdown-item" href="{{route('listSort', ['id' => $tasklist->id, 'sort' => 'Low'])}}" >Low</a></li>
            
          </ul>
        </li>
        
        
      </ul>
      <form class="d-flex">
        <a href="{{route('create', $tasklist->id)}}" class="btn btn-info">Create Task</a>
        </form>
    </div>
  </div>
</nav>
<div class="clearfix"></div>
<br>
@foreach($tasks as $task)
@if($task->owner == $owner)
@if($task->listId == $tasklist->id)
<div class="card">

    <div class="card-header">
        @if ($task->status === "ToDo")
        <h3>{{$task->title}}</h3>
        @else
        <del><h3>{{$task->title}}</h3></del>
        @endif
        @if($task->status === "ToDo") 
            <span class="badge rounded-pill text-dark bg-info">Status: {{$task->status}}</span>
        @else 
            <span class="badge rounded-pill text-light bg-success">Status: {{$task->status}}</span>
        
        @endif
               
        @if ($task->dueDate == $today && $task->status === "ToDo")
        <span class="badge rounded-pill text-dark bg-warning">Due Date: {{$task->dueDate}}</span>
        @elseif ($task->dueDate == $today && $task->status === "Done")
        <span class="badge rounded-pill text-light bg-success">Due Date: {{$task->dueDate}}</span>
        @endif
        @if ($task->dueDate < $today && $task->status === "Done")
        <span class="badge rounded-pill text-light bg-success">Due Date {{$task->dueDate}}</span>
        @elseif ($task->dueDate < $today && $task->status === "ToDo")
        <span class="badge rounded-pill text-light bg-danger">Due Date: {{$task->dueDate}}</span>
        @endif
        @if ($task->dueDate > $today && $task->status === "Done")
        <span class="badge rounded-pill text-light bg-success">Due Date: {{$task->dueDate}}</span>
        @elseif ($task->dueDate > $today && $task->status === "ToDo")
        <span class="badge rounded-pill text-dark bg-info">Due Date: {{$task->dueDate}}</span>
        @endif
        @if ($task->priority === "High")
        <span class="badge rounded-pill text-light bg-danger">Priority: {{$task->priority}}</span>
        @elseif ($task->priority === "Medium")
        <span class="badge rounded-pill text-dark bg-warning">Priority: {{$task->priority}}</span>
        @elseif ($task->priority === "Low")
        <span class="badge rounded-pill text-dark bg-info">Priority: {{$task->priority}}</span>
        @endif
        
    </div>

    <div class="card-body">
        <div class="card-text">
        <div class="float-start fs-4">
        @if ($task->status === "ToDo")
        <h3>{{$task->description}}</h3>
        @else
        <del><h3>{{$task->description}}</h3></del>
        @endif
        

        <br>
        <br>
        <small class="fs-6">Last Updated {{$task->updated_at}}</small>
</div>
<div class="float-end">
    <a href="{{route('edit', $task->id)}}" class="btn btn-success">Edit</a><br><br>
    <form action="{{route('destroy', $task->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
<div class="clearfix"></div>
        
    </div>
    </div>
</div>
<br>
@endif
@endif
@endforeach
</div>
@endauth