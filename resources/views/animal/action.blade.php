 <td align="center"><a href="{{route('animal.edit',$id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size:24px" ></a></i></td>
          
          <td align="center">
            <form action="{{route('animal.destroy',$id) }}" method = "POST">
            @csrf
            @method('DELETE')
            <button><i class="fa fa-trash-o" style="font-size:24px; color:red"></i></button>
            </form>
          </td>