@if (session('alert-message'))
    @push('scripts')
        <script type="text/javascript">
            Swal.fire({
                icon: '{{ session('alert-icon') }}',
                title: '{{ session('alert-type') }}',
                text: '{{ session('alert-message') }}'
            })
        </script>
    @endpush
@endif

@if ($errors->any())
    @push('scripts')
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '@foreach ($errors->all() as $error){{ $error }}<br/>@endforeach'
        })
    </script>
    @endpush
@endif

@if (session('failures'))
    <div class="alert alert-warning">
        <ul>
            @foreach (session('failures') as $failure)
                @foreach ($failure->errors() as $error)
                    <li>Row {{ $failure->row() }}. {{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
@endif
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    },10000);
</script>
