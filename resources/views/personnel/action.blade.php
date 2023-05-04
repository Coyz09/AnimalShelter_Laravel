<td align="center"><a href="{{route('personnel.edit',$id) }}">
            <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px"></a></i></td>

{{--  <a href="{{route('status.update')}}" class="btn btn-danger m-2">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><strong>0</strong></span>            
    </a> --}}
		<td align="center">
            <form action="{{route('status.update',$user_id) }}" method="POST">
            @csrf
            @method('POST')
            <button><i class="fas fa-eraser" style="font-size:24px; color:red"></i></button>
            </form>
        </td>

        <td align="center">
            <form action="{{route('update.status',$user_id) }}" method="POST">
            @csrf
            @method('POST')
            <button><i class="fas fa-undo-alt" style="font-size:24px; color:blue"></i></button>
            </form>
        </td>

          <td align="center">
            <form action="{{route('personnel.destroy',$id) }}" method = "POST">
            @csrf
            @method('DELETE')
            <button><i class="fa fa-trash-o" style="font-size:24px; color:red"></i></button>
            </form>
          </td>