@if(session()->has('success_message'))
    <p class="alert alert-success">
        {{ session()->get('success_message') }}
    </p>
@endif