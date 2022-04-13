@if(session('success'))

    <script>
        new Noty({
            type: "success",
            layout: "topRight",
            text: "{{ session('success') }}",
            timeout: 3000,
            killer: true,
        }).show();
    </script>
@endif
