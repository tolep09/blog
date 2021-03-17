@extends('dashboard.master')

@section('content')
 @if (count($postComments) > 0)
    <table class="table">
        <thead >
            <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Aprovado</th>
            <th scope="col">Usuario</th>
            <th scope="col">Creación</th>
            <th scope="col">Actualización</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($postComments as $postComment)
                <tr>
                    <td>{{ $postComment->id }}</td>
                    <td>{{ $postComment->title }}</td>
                    <td>{{ $postComment->approved }}</td>
                    <td>{{ $postComment->user->name }}</td>
                    <td>{{ $postComment->created_at->format('d-m-Y') }}</td>
                    <td>{{ $postComment->updated_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('post-comment.show', $postComment->id) }}" class="btn btn-sm btn-dark">
                            <li class="fa fa-eye"></li>
                        </a>
                        
                        <button class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#deleteModal" 
                            data-id="{{ $postComment->id }}" type="button">
                            <li class="fa fa-trash"></li>
                        </button>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $postComments->links() }}

    <!--Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Eliminar el comentario seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" action="{{ route('post-comment.destroy', 0) }}" method="POST"
                    data-action="{{ route('post-comment.destroy', 0) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </div>
            </div>
        </div>
    </div>


    <script>
        window.onload = function() {
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)

                var action = $('#formDelete').attr('data-action').slice(0, -1)

                $('#formDelete').attr('action', (action +  id))

                modal.find('.modal-title').text('Eliminar el comentario ' + id)
            });
        };
    </script>
@else
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">No hay comentarios para el post {{ $post->title }}</h4>
    </div>
@endif
@endsection
