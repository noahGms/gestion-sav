@if(session()->has('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-light">
                <strong class="me-auto">Message</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session()->get('success') }}
            </div>
        </div>
    </div>
    <script>
        const successToastEl = document.getElementById('successToast')
        const toast = new bootstrap.Toast(successToastEl)
        toast.show()
    </script>
@endif

@if(session()->has('error'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-light">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session()->get('error') }}
            </div>
        </div>
    </div>
    <script>
        const errorToastEl = document.getElementById('errorToast')
        const toast = new bootstrap.Toast(errorToastEl)
        toast.show()
    </script>
@endif

