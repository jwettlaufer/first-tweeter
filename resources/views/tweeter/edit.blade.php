@extends ('layout')

@section('title')
Edit Tweet
@endsection
@section('content')
<p>Edit your tweet below.</p>
@include('partials.errors')
<form method="post" action="{{route('tweeter.update', $tweet->id)}}">
  @csrf

  @method('PATCH')
  <label for="message">
    <strong>Edit Message:</strong>
    <textarea name="message" id="message" rows="10" cols="30">{{$tweet->message}}</textarea>
  </label>
  <label for="author">
  <strong>Author Name:</strong>
  <input type="text" name="author" id="author" value="{{$tweet->author}}">
  </label>
  <input type="submit" value="Update Tweet">
</form>
@endsection
