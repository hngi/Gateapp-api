<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>{{ config('app.name') }}</title>
  </head>
  <body>
    <h2>OTP Dev Check</h2>
    <div class="col-12" style="background: brown; color: white;">
        @foreach($user as $user)
        <div>{{$user->name}} | {{$user->user_type}} | {{$user->verifycode}}</div> <br>
        @endforeach
    </div>
  </body>
</html>