  <!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="bishal udash, cgconnect login page">
    <meta name="Bishal" content="bishal udash, cgconnect login page">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>CG Connect | Login</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.css" rel="stylesheet" >

    <!-- Custom styles for this template -->
    <link href="{{ url('css/floating-labels.css') }}" rel="stylesheet">
    <style type="text/css">
      .ajax-message{
        display: none;
      }
    </style>
  </head>
  <body>

    <div class="form-signin">
     <div class="text-center mb-4">
      <img class="mb-4" src="{{ url('img/cglogo.png') }}" alt="" width="220" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    </div>
    
    {{-- Session --}}
    @php  
      $tempemail = Session::get('tempemail');
    @endphp   
    @include('includes.flash')
     {{-- Login Form --}}
    
    {!! Form::open(['method'=>'POST', 'action'=>'User\UserAuthController@login'])!!}
      <div class="form-label-group">
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{$tempemail?? ''}}"autofocus>
        <label for="inputEmail">Email address</label>

        <div class="text-danger mb-2">
          @if ($errors->any())
            <span>{{ $errors->first('email') }}</span>
          @endif
        </div>
      </div>
      
      <div class="form-label-group">
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
        <label for="inputPassword">Password</label>

        <div class="text-danger mb-2">
         @if ($errors->any())
            <span>{{ $errors->first('password') }}</span>
          @endif
        </div>
      </div>
       

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    {!! Form::close()!!}
    <div class="text-center mt-2">
      <a href="{{ route('forgot-password') }}">Forgot Password</a>
    </div>

    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018-{{date('Y')}}</p>
  </div>
  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.js"></script>
  </body>
  </html>
