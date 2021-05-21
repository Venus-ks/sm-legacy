@extends('email.main')

@section('content')
    
<h4>
    {{$info['institute_title']}} [{{$info['journal_title']}}] 최종논문 검토 요청 {{$article_id}}
</h4>
<p>편집위원장님께</p>
<p>안녕하세요?</p>
<p>아래의 원고가 완료되었기에 논문 확인요청을 드립니다. 원고를 보시고 대로 수정이 잘 이루어졌는지, 혹은 수정이 미흡하여 추가로 수정해야 하는지 확인 부탁드립니다. 논문에 대한 자세한 내용을 확인 하시려면 아래 링크를 클릭하신 후 진행하시거나, 온라인투고시스템에 편집위원장 아이디로 로그인 하신 후 이용하시기 바랍니다.</p>
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