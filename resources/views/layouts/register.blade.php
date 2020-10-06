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
    <title>Zarejestruj się w sklepie</title>
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
                <form action="userregister" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nazwa</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adres e-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hasło</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Powtórz hasło</label>
                        <input type="password" class="form-control" name="password2">
                    </div>
                    <button type="submit" class="btn btn-success ">Zarejestruj</button>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>
