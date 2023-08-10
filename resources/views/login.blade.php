<title>Login</title>

<body>
@include('header')
<div class="container">
    <h4 style="text-align: center;">Login</h4>
<form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
@csrf
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" name="username">

  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
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
        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>