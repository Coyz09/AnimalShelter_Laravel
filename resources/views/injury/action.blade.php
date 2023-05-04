 <td align="center">
 	<a href="{{route('injury.edit',$id) }}">
    <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:30px"></a></i>

	<form action="{{route('injury.destroy',$id) }}" method = "POST">
	@csrf
	@method('DELETE')
	<button><i class="fa fa-trash-o" style="font-size:30px; color:red"></i></button>
	</form>
</td>