@if (isset(Auth::user()->email))
<script>
    window.location = "/main";
</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Zaloguj się do sklepu</title>
</head>
<body>
@if ($message = Session::get('error'))
    <div class="alert alert-danger" >{{$message}}</div>
    
@endif

@if ($errors->any())
    <div class="alert alert-danger" >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>   
    
@endif
    <div class="container vh-100">
        <div class="row vh-100 justify-content-center align-content-center">
            <div class="col-md-6 mb-5 pb-5">
                <form action="user" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adres e-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hasło</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-success ">Zaloguj</button>  <a class="btn btn-primary" href="{{url('/register')}}">Zarejestruj się</a>
                </form>
            </div>
           
        </div> 
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  @if ($message = Session::get('message'))
<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <!-- Position it -->
  <div style="position: absolute; bottom: 0; right: 10px;">

    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2500">
      <div class="toast-header">
        {{-- <img src="..." class="rounded mr-2" alt="..."> --}}
        <strong class="mr-auto">Shop</strong>
        <small class="text-muted">just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        {{$message}}
      </div>
    </div>
  </div>
</div>
    
@endif
    <script>
      $(document).ready(function(){
        $('.toast').toast('show');
      });
    </script>
</body>
</html>
