@extends('email.main')

@section('content')
    
<h4>
    {{$info['institute_title']}} [{{$info['journal_title']}}] 최종논문 검토 요청 {{$article_id}}
</h4>
<p>편집위원장님께</p>
<p>편집위원장님에 의해 '수정 후 게재가'로 최종 심사완료 된 논문이 저자에 의해서 최종 수정 완료 되었습니다.</p>
<p style="text-align: center">
    <a href='{{ $sm_url }}{{ $add_url }}' target='_blank'>
        Registration page
    </a>
</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
</p>
    
@endsection