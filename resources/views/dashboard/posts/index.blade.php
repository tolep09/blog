@extends('dashboard.master')

@section('content')
    <div class="col-lg-12 my-3">
        <a href="{{ route('posts.create') }}" class="btn btn-success">+Nuevo Post</a>
    </div>
    <table class="table">
        <thead >
            <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Posteado</th>
            <th scope="col">Categoría</th>
            <th scope="col">Creación</th>
            <th scope="col">Actualización</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->posted }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td>{{ $post->created_at->format('d-m-Y') }}</td>
                    <td>{{ $post->updated_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-dark">Ver</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                            Edit</a>
                        
                        <button class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#deleteModal" 
                            data-id="{{ $post->id }}" type="button">Del
                        </button>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

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
                <p>¿Eliminar el post seleccionado?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" action="{{ route('posts.destroy', 0) }}" method="POST"
                    data-action="{{ route('posts.destroy', 0) }}">
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

                modal.find('.modal-title').text('Eliminar el post ' + id)
            });
        };
    </script>
@endsection
