@extends('layout')

@section('title')
List of Tweets
@endsection
@section('content')
@if(session()->get('success'))
<div role="alert">
  {{session()->get('success')}}
</div>
@endif
<p>Tweets posted:</p>
<ul>
  @foreach($tweets as $tweet)
  <li>
      <h2>{{$tweet->author}}</h2>
      <p>
        {{$tweet->message}}
      </p>
      <ul>
        <li>
            <a href="{{route('tweeter.show', $tweet->id)}}">
              View
            </a>
        </li>
        @auth
        <li>
            <a href="{{route('tweeter.edit', $tweet->id)}}">
              Edit Tweet
            </a>
        </li>
        <li>
            <form action="{{route('tweeter.destroy', $tweet->id)}}" method="post">
              @csrf
                @method('DELETE')
                <input type="submit" value="Delete Tweet">
            </form>
        </li>
        @endauth
      </ul>
  </li>
  @endforeach
</ul>
@endsection
