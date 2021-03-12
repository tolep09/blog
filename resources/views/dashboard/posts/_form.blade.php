            @csrf
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" 
                value="{{ old('title', $post->title) }}">
                @error('title')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="url_clean">Url limpia</label>
                <input type="text" class="form-control" id="url_clean" name="url_clean" 
                value="{{ old('url_clean', $post->url_clean) }}"
                {{ $post->url_clean != '' ? 'disabled' : '' }}>
                @error('url_clean')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">--Seleccione categoria--</option>
                    @foreach($categories as $title => $id)
                        <option {{ $post->category_id == $id ? 'selected' : '' }} 
                            value="{{ $id }}">{{ $title }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="posted">Posteado</label>
                <select class="form-control" name="posted" id="posted">
                    @include('dashboard.partials.option-yes-not', ['val' => $post->posted])
                </select>

                @error('posted')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tags_id">Tags</label>
                <select multiple class="form-control" name="tags_id[]" id="tags_id">
                    <option value="">--Seleccione etiquetas--</option>
                    @foreach($tags as $title => $id)
                        <option {{ in_array($id, old('tags_id') ? : $post->tags()->pluck('id')->toArray()) ? 'selected' : '' }}
                            value="{{ $id }}">{{ $title }}
                        </option>
                    @endforeach
                </select>

                @error('tags_id')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="content">Contenido</label>
                <textarea class="form-control" id="content" name="content" rows="3">
                {{ old('content', $post->content) }}</textarea>
                @error('content')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input type="hidden" id="token" value="{{ csrf_token() }}">
            
            <button type="submit" class="btn btn-primary mb-2">Guardar</button>