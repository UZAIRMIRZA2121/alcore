@if (session('success'))
<div id="alert-message" class="alert alert-success alert-dismissible fade show m-2" role="alert">
    <i class="bi bi-exclamation-octagon me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div id="alert-message" class="alert alert-danger alert-dismissible fade show m-2 " role="alert">
    <i class="bi bi-exclamation-octagon me-1"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif

@if (session('warning'))
<div id="alert-message" class="alert alert-warning alert-dismissible fade show m-2" role="alert">
    <i class="bi bi-exclamation-octagon me-1"></i>
    {{ session('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif

@if (session('status'))
<div id="alert-message" class="alert alert-danger alert-dismissible fade show m-2" role="alert">
    <i class="bi bi-exclamation-octagon me-1"></i>
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif

<script>
    // Select the alert element using its id
    const alertMessage = document.getElementById('alert-message');

    // If the alert element exists, remove it from the DOM after 3 seconds
    if (alertMessage) {
        setTimeout(() => {
            alertMessage.remove();
        }, 3000);
    }
</script>