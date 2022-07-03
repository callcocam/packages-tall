<div class="form-group">
    <label for="content">Content</label>
    @error('content')
        <div class="validation--error">{{$message}}</div>
    @enderror
    <input name="content" id="content" type="text"/>
</div>