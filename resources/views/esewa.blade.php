<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Redirecting to eSewa</title>
</head>
<body>
    <form action="{{ $process_url }}" method="POST" id="esewa-form" novalidate>
        @csrf
        @foreach ($form_data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            document.getElementById('esewa-form').submit();
        });
    </script>
</body>
</html>
