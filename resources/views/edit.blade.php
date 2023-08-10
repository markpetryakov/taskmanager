<title>Edit Task</title>
@include ("header")

<div class="container">
    <h4 style="text-align: center;">Edit Task</h4>
    <form action="{{route('edit.post', $task->id, $task->listId)}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
@csrf
@method('PUT')
<input type="hidden" name="owner" value="{{auth()->user()->id}}">
<input type="hidden" name="listId" value="{{$tasklist->id}}">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="{{$task->title}}">

  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Task description</label>
    <input type="text" class="form-control" name="description" value="{{$task->description}}">
  </div>
  <div class="mb-3">
    <label for="priority" class="form-label">Priority Level</label>
<select name="priority" id="priority" class="form-control">
@foreach ($priorities as $priority)
<option placeholder="{{$task->priority}}" value="{{$priority['value']}}">{{$priority['label']}}</option>
@endforeach
</select>

  </div>
  <div class="mb-3">
    <label for="status" class="form-label">Status</label>
<select name="status" id="status" class="form-control">
@foreach ($statuses as $status)
<option placeholder="{{$task->status}}" value="{{$status['value']}}">{{$status['label']}}</option>
@endforeach
</select>

  </div>
  <div class="mb-3">
    <label for="dueDate" class="form-label">Due Date</label>
    <input type="date" class="form-control" name="dueDate" value="{{$task->dueDate}}">
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
  <button type="submit" class="btn btn-primary">Update Task</button>
  <a href="{{route('list', $tasklist->id)}}" class="btn btn-info">Back to Tasks</a>
</form>

</div>

