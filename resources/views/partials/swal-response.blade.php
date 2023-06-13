<script>    
  @if(session('success') === true)
    @if(session('message'))
      swal('{{ session('title') }}', '{{ session('message') }}', '{{ session('alert') }}');
    @endif
  @elseif (session('success') === false)
    @if(session('error'))
      swal('{{ session('title') }}', '{{ session('error') }}', '{{ session('alert') }}');
    @elseif (session('errors'))
      swal('{{ session('title') }}', '{{ session('errors') }}', '{{ session('alert') }}');
    @endif
  @endif
</script>