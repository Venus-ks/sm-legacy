@extends('email.main')

@section('content')
    
<p>안녕하십니까. {{$info['institute_title']}} 편집위원회입니다.</p>
<p>
귀하께서 「{{$info['journal_title']}}」에 투고해주신 논문은 정상적으로 접수 처리되었으며,
심사가 완료되는대로 다시 이메일로 공지드리겠습니다.
(약 4~5주 가량 소요되며, 투고시스템에서 심사현황을 수시로 확인하실 수 있습니다.)
</p>
<p>
논문 Author(공동저자 포함)는 저희 학회규정상 {{$info['institute_title']}} 회원이어야 하며, 미납회비가 없어야 합니다. 따라서 아직 회원이 아니신 경우 회원가입을 해주시고, 회원이신 경우 미납회비가 없는지 확인하여 주시기 바랍니다.
</p>
<p>
회원가입 및 미납회비와 관련된 사항은 {{$info['institute_title']}} 사무국에서 확인하실 수 있습니다.
</p>
<p>
{!!$info['bank_comment']!!}
</p>
    
@endsection