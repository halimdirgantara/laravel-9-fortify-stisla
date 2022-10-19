@if (session('alert-message'))
    <div class="alert alert-{{ session('alert-type') }}">
        {{ session('alert-message') }}
    </div>
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