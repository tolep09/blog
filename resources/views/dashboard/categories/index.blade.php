@extends('dashboard.master')

@section('content')
    <div class="col-lg-12 my-3">
        <a href="{{ route('categories.create') }}" class="btn btn-success">
            <li class="fa fa-plus"></li> Nueva Categoria
        </a>
    </div>
    <table class="table">
        <thead >
            <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            <th scope="col">Creación</th>
            <th scope="col">Actualización</th>
            <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                    <td>{{ $category->updated_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-dark">
                            <li class="fa fa-eye"></li>
                        </a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">
                            <li class="fa fa-edit"></li>
                        </a>
                        
                        <button class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#deleteModal" 
                            data-id="{{ $category->id }}" type="button">
                            <li class="fa fa-trash"></li>
                        </button>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}

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
                <p>¿Eliminar la categoria seleccionada?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <form id="formDelete" action="{{ route('categories.destroy', 0) }}" method="POST"
                    data-action="{{ route('categories.destroy', 0) }}">
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

                modal.find('.modal-title').text('Eliminar la categoria ' + id)
            });
        };
    </script>
@endsection
