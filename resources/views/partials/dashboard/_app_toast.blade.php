<script type="text/javascript">
    {{-- Success Message --}}
    @if (Session::has('success'))
    Swal.fire({
    icon: 'success',
    title: 'Done',
    text: '{{ Session::get("success") }}',
    confirmButtonColor: "#3a57e8"
    });
    @endif
    {{-- Errors Message --}}
    @if (Session::has('error'))
    Swal.fire({
    icon: 'error',
    title: 'Opps!!!',
    text: '{{Session::get("error")}}',
    confirmButtonColor: "#3a57e8"
    });
    @endif
    @if(Session::has('errors') || ( isset($errors) && is_array($errors) && $errors->any()))
    Swal.fire({
    icon: 'error',
    title: 'Opps!!!',
    text: '{{Session::get("errors")->first() }}',
    confirmButtonColor: "#3a57e8"
    });
    @endif

    function notify_fire(message, title='Done', icon='success') { 
        Swal.fire({
        icon: icon,
        title: title,
        text: message,
        confirmButtonColor: "#3a57e8"
        });
    }
    function notify_toast(message, title='Done', icon='success') {
        Swal.toast({
        icon: icon,
        title: title,
        text: message,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
    }
    // Loading modal
    function checkAndCloseLoadingModal() {
        if ($('.modal.show').length > 1) {
            disable_loading();
        }

        if (shouldBeClosed) {
            disable_loading();
        } else if (!shouldBeClosed) {
            enable_loading();
        }
    }

    var shouldBeClosed = true;

    var checkLoadingInterval = setInterval(checkAndCloseLoadingModal, 500); 

    $('.modal:not(#global_loading)').on('show.bs.modal', function () {
        disable_loading();
    });
    function enable_loading () {
        $('#global_loading').modal('show');
        shouldBeClosed = false;
    }

    function disable_loading () {
        $('#global_loading').modal('hide');
        shouldBeClosed = true;
    }


    function showLoading(title) {
        Swal.fire({
            title: title,
            text: "Please wait.",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function closeLoading() {
        Swal.close();
    }

    function checkAuthenticatedUser() {
        if ({{ auth()->guest() ? 'true' : 'false' }}) {
            window.location = "{{ route('dashboard') }}";
        }
    }

    function resetSession() {
        $crisp.push(["do", "session:reset"]);
    }


    $crisp.push(["on", "chat:opened", function() {
        var loginModal = new bootstrap.Modal($('#loginModal')[0]);

        if ({{ auth()->guest() ? 'true' : 'false' }}) {
            $crisp.push(["do", "chat:close"]);

            Swal.fire({
                title: 'LOGIN REQUIRED!',
                text: 'Please sign in to your account to access the chat box.',
                icon: 'warning',
                confirmButtonText: 'OK',
            });

            // .then((result) => {
            //     if (result.isConfirmed) {
            //         event.preventDefault();
            //         loginModal.show();
            //     }
            // });
        }else{
            $crisp.push(["do", "chat:open"]);
        }
    }]);
</script>