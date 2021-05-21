@extends('email.main')

@section('content')
    
<h4>
    {{$info['institute_title']}} [{{$info['journal_title']}}] {{$article_id}}
</h4>
<p>To {{ $name }} Reviewer</p>
<p>안녕하십니까? 바쁘신 가운데, 심사를 수락해주셔서 진심으로 감사드립니다.</p>
<p>위원님께서 맡아주신 논문의 심사기간은 {{ $expire_date }} 이내이며,
아래 링크를 클릭하시거나, 「{{$info['journal_title']}}」 온라인투고시스템(<a href="{{ $sm_url }}">{{ $sm_url }}</a>)에 직접 접속하시어
상기 기한 내 Review을 제출해주시기 바랍니다.</p>
<p>문의 또는 요청사항이 생기시면 언제든지 연락주십시오. 감사합니다.</p>
<p style="text-align: center">
    <a href='{{ $sm_url }}{{ $add_url }}' target='_blank'>
        논문심사
    </a>
</p>
<p>※ 「{{$info['journal_title']}}」 온라인투고시스템을 통한 심사의뢰가 처음이신 경우 로그인 초기정보는 다음과 같습니다.<br/>
로그인 ID는 처음 심사의뢰를 수신하였던 선생님의 이메일 계정이며,
‘비밀번호 찾기’ 기능에 로그인 ID(이메일 계정)을 입력하시면 해당 메일로 비밀번호 재설정 기능이 담긴 메일이 발송되오니, 재설정 후 로그인 해주시기를 부탁드립니다.
</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
</div>
    
@endsection