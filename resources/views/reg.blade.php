<title>Registration</title>

<body>
@include('header')
<div class="container">
    <h4 style="text-align: center;">Registration</h4>
<form action="{{route('reg.post')}}" method="POST"class="ms-auto me-auto mt-3" style="width: 500px">
@csrf
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" class="form-control" name="username">

  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
    
  </div>
  <div class="mt-3" >
        @if($errors->any())
        <div class="col-12">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        </div>
        @endif
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>
</body>