<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>

</head>
<body>

    <div id="app">
        <example-component></example-component>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
        window.Echo.channel('task.created')
            .listen('.myEvent', (e) => {
                console.log(e);
            });
    </script>
</body>
</html>
