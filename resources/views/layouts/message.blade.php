@session('success')
    <div class="container alert alert-success container alert-dismissible fade show p-2 d-flex align-items-center"
        role="alert">
        <strong>Success::</strong> {{ session('success') }}
        <button type="button" class="btn-close ms-auto p-2 pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession

@session('alert')
    <div class="container alert alert-danger alert-dismissible fade show p-2 d-flex align-items-center" role="alert">
        <strong>Danger::</strong> {{ session('alert') }}
        <button type="button" class="btn-close ms-auto p-2 pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession

@session('warning')
    <div class="container alert alert-warning alert-dismissible fade show p-2 d-flex align-items-center" role="alert">
        <strong>Warning::</strong> {{ session('warning') }}
        <button type="button" class="btn-close ms-auto p-2 pt-3" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endsession
