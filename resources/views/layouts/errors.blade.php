@if(count($errors))                    
    <div class="form-group">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    <li>@lang($error)</li>
                @endforeach
            </ul>
            
        </div>
        
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
        {{ session('status') }}
    </div>
@endif