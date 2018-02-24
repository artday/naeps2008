@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        Success: {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-success" role="alert">
        Info: {{ Session::get('info') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-success" role="alert">
        Warning: {{ Session::get('warning') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-success" role="alert">
        Error: {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-success" role="alert">
        Status: {{ Session::get('status') }}
    </div>
@endif