@extends('email.main')

@section('content')
    
<h4>
    {{$info['institute_title']}} [{{$info['journal_title']}}] 최종논문 검토 요청 {{$article_id}}
</h4>
<p>편집위원장님께</p>
<p>&nbsp; 본 학회 {{$info['institute_title']}}지에 {{$mb_name}}님이 투고한 원고의 심사결과가 편집위원장님에 의해 '게재불가'로 최종논문 검토 완료되었습니다. </p>
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