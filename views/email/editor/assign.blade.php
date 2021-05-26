@extends('email.main')

@section('content')
    
<h4>
    {{$info['institute_title']}} [{{$info['journal_title']}}] Reviewer 추천의뢰 {{$article_id}}
</h4>
<p>편집위원장님께</p>
<p>아래와 같이 본 {{$info['institute_title']}}지에 투고된 `{{ $title }}`에 대한 Reviewer 3분을 추천해 주시기 바랍니다. 논문에 대한 자세한 내용을 확인 하시려면 아래 링크를 클릭하신 후 진행하시거나, 온라인투고시스템에 편집위원장 아이디로 로그인 하신 후 추천하시기 바랍니다.</p>
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