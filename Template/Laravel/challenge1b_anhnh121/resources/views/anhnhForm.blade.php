
<form action="{{route('postForm')}}" method="post">
	<!-- @csrf --> 
	{{ csrf_field() }}
	<input type="text" name="HoTen">
	<input type="submit">
</form>
