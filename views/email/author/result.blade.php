@extends('email.main')

@section('content')
    
<p>안녕하십니까. {{$info['institute_title']}} [{{$info['journal_title']}}] 편집위원회입니다.</p>
<p>먼저 「{{$info['journal_title']}}」에 논문을 투고해주셔서 진심으로 감사드립니다.</p>
<p>수합된 심사결과를 투고시스템에서 확인부탁드립니다.</p>
<p>감사합니다.</p>
<p style="text-align: center">
    <a href='{{ $sm_url }}{{ $add_url }}' target='_blank'>
        논문심사수락여부확인
    </a>
</p>
    
@endsection