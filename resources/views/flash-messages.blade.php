{{--flash-messages.blade.php--}}

@if (session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
@endif