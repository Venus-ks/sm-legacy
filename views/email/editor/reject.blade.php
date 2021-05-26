@extends('email.main')

@section('content')
    
<p>편집위원장님</p>
<p>먼저 「{{$info['journal_title']}}」에 논문을 투고해주셔서 진심으로 감사드립니다.</p>
<p>&nbsp; 본 학회 {{$info['institute_title']}}지에 {{ $mb_name }}님이 투고한 원고의 심사결과가 '게재불가'로 최종논문 검토 완료되었습니다.</p>
<p style="text-align: center">
    <a href='{{ $sm_url }}{{ $add_url }}' target='_blank'>
        논문심사수락여부확인
    </a>
</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
</p>
@endsection