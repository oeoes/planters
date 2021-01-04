@if ($message = Session::get('success'))
<script>
    Toast.fire({
        icon: 'success',
        title: 'Success: {{ $message }}',
        position: 'bottom-end',
        timerProgressBar: true
    })
</script>
@endif

@if ($message = Session::get('error'))
<script>
    Toast.fire({
        icon: 'error',
        title: 'Error: {{ $message }}',
        position: 'bottom-end',
        timerProgressBar: true
    })
</script>
@endif

@if ($message = Session::get('warning'))
<script>
    Toast.fire({
        icon: 'warning',
        title: 'Warning: {{ $message }}',
        position: 'bottom-end',
        timerProgressBar: true
    })
</script>
@endif

@if ($message = Session::get('info'))
<script>
    Toast.fire({
        icon: 'info',
        title: 'Info: {{ $message }}',
        position: 'bottom-end',
        timerProgressBar: true
    })
</script>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif