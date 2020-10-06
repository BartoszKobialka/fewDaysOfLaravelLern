<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    
<title>@if (Request::segment(2) !== 'cart') {{'Koszyk'}} 
  @else 
  {{'Produkty'}}
   @endif</title>
    <script>
        function send(tar){
            let id = tar.value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  window.location = '/main/cart';
                }
            };
            xhttp.open("GET", "/main/"+tar, true);
            xhttp.send();
            
        }
    </script>
</head>
<body>


    @if (isset(Auth::user()->email))
    <ul class="nav justify-content-end avbar-dark bg-dark">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/main/cart')}}">Koszyk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/main')}}">Produkty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Zalogowano jako: {{Auth::user()->name}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/logout')}}">Logout</a>
        </li>
      </ul>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
    <div class="container">
        <div class="row justify-content-center">
          @if (session()->get('isAdmin') and Request::segment(2) !== 'cart')
            <div class="col-6">
                <form action="addprod" method="post">
                  @csrf
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nazwa produktu</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">Cena</label>
                      <input type="number" step="0.01" class="form-control" name="cost">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Opis</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                  <button type="submit" class="btn btn-success">Dodaj produkt</button>
              </form>
            </div>
          @endif
            <div class="col-12">
                <table class="table table-dark mt-5">
                    <thead>
                      <tr>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Opis</th>
                      </tr>
                    </thead>
                    <tbody>
                      @yield('content')
                    </tbody>
                  </table>
                  @if(Request::segment(2) === 'cart')
                    <div class="col-6">
                      <form action="/mail/order" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Zamów</button>
                    </form>
                  </div>
                  @endif
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