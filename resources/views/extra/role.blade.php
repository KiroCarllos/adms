<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Role</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('extra/extra.css') }}" />
  </head>
  <body>
    <div class="role">
      <h1 id="heading">Are you a?</h1>
{{--        @dd(auth()->user()->role)--}}
      <div class="icons">
        <a href="{{ route("roleHead","Bachelor") }}">
          <img id="head" src="{{ asset('extra/head.png') }}" alt="head" />
        </a>

        <a href="{{ route("role") }}">
          <img id="member" src="{{ asset('extra/member.png') }}" alt="member" />
        </a>
      </div>
    </div>
  </body>
</html>
