<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <link rel="shortcut icon" href="{{ asset('home/images/logo.png') }}">
    <link href="{{ asset('home/css.css') }}" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='{{ asset('home/js/jquery-1.7.2.min.js') }}'></script>
    <script language="javascript">
        $(function () {
            var codeIntVal = $('#time').text();
            timename = setInterval(function(){
                codeIntVal--;
                $('#time').text(codeIntVal);
                if (codeIntVal < 1) {
                    window.history.go(-1);
                    clearInterval(timename);
                }
            }, "1000");
        });
    </script>
</head>
<body>
<div class="container">
    <section class="error-wrapper" style="text-align: center">
        <h3>{{ $message['msg'] }}</h3>
        <h5><i id="time" style="font-size: 18px;color: red">{{ $message['time'] }}</i> 秒后即将返回...</h5>
    </section>

</div>
</body>
</html>