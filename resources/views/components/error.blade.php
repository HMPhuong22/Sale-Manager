@props(['field'])

@error($field)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.querySelector('[name="{{ $field }}"]');
            if (input) {
                input.classList.add('is-invalid');
                input.setAttribute('title', '{{ $message }}');
                $(input).tooltip('show');
            }
        });
    </script>
@enderror