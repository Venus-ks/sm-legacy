<html xmlns='http://www.w3.org/1999/xhtml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title></title>
</head>

<body>
    <table width='750' border='0' cellspacing='0' cellpadding='0' style="line-height:1.5rem">
        <tr>
            <td height='85' align='center' valign='top'><img src='{{ $info['logo_url'] }}' /></td>
        </tr>
        <tr>
            <td height='15'></td>
        </tr>
        <tr>
            <td height='50' align='left' valign='top'>

                @yield('content')

                <table width='750' border='0' cellspacing='0' cellpadding='0' style="background-color: #FFF;font-size:0.8rem;margin-top:1rem;border:8px solid #ccc;padding:0.5rem;letter-spacing:-1px">
                    <tr>
                        <td align='left'>
                            <p>
                                {{ $info['institute_title'] }} Online Submission {{ $editor_name }}<br />
                                {{ $info['address'] }}<br /><br />
                                Tel : {{ $info['editor_tel'] }}<br>
                                E-mail : <a href='mailto:{{ $info['editor_email'] }}'>{{ $info['editor_email'] }}</a><br />
                                Home : <a href='{{ $info['site'] }}'>{{ $info['site'] }}</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>