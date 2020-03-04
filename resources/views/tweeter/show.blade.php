@extends ('layout')
@section('title')
View Tweet
@endsection
@section('content')
@include('partials.errors')

<h2>{{$tweet->author}}</h2>
<p>
  {{$tweet->message}}
</p>
@endsection
