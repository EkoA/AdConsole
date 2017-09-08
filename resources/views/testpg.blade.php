<form method="post" action="{{route('post.test_page')}}">
  {{-- csrf_field() --}}
  <input type="text" name="car" /><br>
  <input type="submit" value="Submit">
</form>
