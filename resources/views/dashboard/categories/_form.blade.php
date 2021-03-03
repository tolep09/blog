
    
        
            @csrf
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" 
                value="{{ old('title', $category->title) }}">
                @error('title')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="url_clean">Url limpia</label>
                <input type="text" class="form-control" id="url_clean" name="url_clean" 
                value="{{ old('url_clean', $category->url_clean) }}">
            </div>

            
            <button type="submit" class="btn btn-primary mb-2">Guardar</button>