@extends('email.main')

@section('content')
    
<div style="word-wrap: break-word; word-break: break-all;">
    <h4>
    </h4>
    <p>
        To change your password, Use this link. The URL link is
    </p>
    <p style="text-align: center">
        <a href='{{ $sm_url }}admin/changepw.php?a={{ $email }}&b={{ $enc }}' target='_blank'>
                Change password
        </a>
    </p>
    <p>
        Thank you. if you have any questions, please do not hesitate to contact me.
    </p>
    <p>
        Sincerely, 
    </p>
    <p>
        {{ $info['editor_name'] }}
    </p>
</div>

@endsection