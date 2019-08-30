@if(Session::has('message'))
    <div class="toast" id="sessiontoast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" data-amimate="true"
         style="position: fixed; top:60px; right: calc((100%/2) - 150px); z-index: 1050; width: 300px">
        <div class="toast-header">
            <img src="{{ URL::to('favicon.png') }}" class="rounded mr-2" alt="notification">
            <strong class="mr-auto">Notification</strong>
        </div>
        <div class="toast-body">
            <p class="lead">{{ Session::get('message') }}</p>
        </div>
    </div>
@endif

<div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000" data-amimate="true"
        style="position: fixed; top:60px; right: calc((100%/2) - 150px); z-index: 1060; width: 300px">
    <div class="toast-header">
        <img src="{{ URL::to('favicon.png') }}" class="rounded mr-2" alt="notification">
        <strong class="mr-auto text-center">Notification</strong>
    </div>
    <div class="toast-body">
        <p class="lead text-center"></p>
    </div>
</div>
