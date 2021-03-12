@extends('dashboard.master')

@section('content')
<div class="col-lg-6 my-3">
    <form action="{{ route('post-comment.post', 1) }}" id="filterForm">
        <div class="form-row">
            <div class="col-lg-10">
                <select id="filterPost" class="form-control">
                    @foreach ($posts as $p)
                            <option value="{{ $p->id }}"
                                {{ $post->id == $p->id ? 'selected' : ''}}
                            >
                                {{ Str::limit($p->title, 30) }}
                            </option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <button type="sumit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
</div>

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
                        <a href="{{ route('post-comment.show', $postComment->id) }}" class="btn btn-sm btn-dark">Ver</a>
                        
                        <button class="btn btn-sm btn-danger" data-toggle="modal" 
                            data-target="#deleteModal" 
                            data-id="{{ $postComment->id }}" type="button">Del
                        </button>

                        <button type="button" id=""  data-id="{{ $postComment->id }}" 
                            class="btn {{ $postComment->approved == '1' ? 'btn-primary' : 'btn-danger' }}
                             btn-sm approved">
                            {{ $postComment->approved == '1' ? 'Aprobado' : 'Rechazado' }}
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
        document.querySelectorAll('.approved').forEach(btn => {
            btn.addEventListener("click", function(e) {
                var id = btn.getAttribute('data-id');
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');

                fetch("{{ URL::to('/') }}/dashboard/post-comment/approved/" + id, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(response => {
                    if (response == '0') {
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-danger');
                        btn.innerHTML = 'Rechazado';
                    } else {
                        btn.classList.remove('btn-danger');
                        btn.classList.add('btn-primary');
                        btn.innerHTML = 'Aprobado';
                    }
                });
            });
        });
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

<script>
    window.onload = function() {
        $('#filterForm').submit(function(){
            var action = $(this).attr('action');
            action = action.replace(/[0-9]/g, $('#filterPost').val());
            
            var tokens = action.split('/');

            for (var i = 0; i < tokens.length; i++) {
                if (tokens[i].indexOf('localhost') > -1) {
                    tokens[i] = 'localhost:8000';
                    break;
                }
            }
            action = tokens.join('/');
            $(this).attr('action', action);
        });
    };
</script>
@endsection
