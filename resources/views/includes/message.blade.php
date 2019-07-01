@if(Session::has('message'))
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" data-amimate="true">
        <div class="toast-header">
            <img src="favicon.png" class="rounded mr-2" alt="notification">
            <strong class="mr-auto">Notification</strong>
        </div>
        <div class="toast-body">
            {{ Session::get('message') }}
        </div>
    </div>
@endif