<form class="box hidden" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box__input">
        <input class="box__file" type="file" name="uploadFile" id="fileHidden" data-multiple-caption="{count} files selected" multiple />
        <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
        <button class="box__button" type="submit">Upload</button>
    </div>
    <div class="box__success">Done!</div>
    <div class="box__error">Error! <span></span>.</div>
</form>

