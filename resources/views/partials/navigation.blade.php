<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{route('tweeter.index')}}">Tweeter-Test</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{route('tweeter.index')}}">Index</a></li>
      @auth
      <li><a href="{{route('tweeter.create')}}">Create</a></li>
      @endauth
    </ul>
  </div>
</nav>
