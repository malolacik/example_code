

@if(session('successMessage'))
    <div class="col-sm-offset-1 col-sm-10">
        <div class="alert alert-success" role="alert">
            <ul>
                <li>{{ session('successMessage') }}</li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
@endif




