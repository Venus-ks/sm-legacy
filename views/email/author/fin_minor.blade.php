@extends('email.main')

@section('content')
    
<p>{{$info['institute_title']}} 최종논문 검토 완료 {{ $article_id }}</p>
<p>{{$mb_name}} 저자님께</p>
<p>안녕하세요?</p>
<p>&nbsp;본 학회 {{$info['institute_title']}}지에 투고해 주신 원고의 심사결과가 완료되었습니다. 이에 논문 추가 수정을 요청드리오니 심사결과를 온라인투고시스템에서 확인해 주시기 바라며, 논문수정표와 최종논문을 투고시스템에 업로드 해 주시기 바랍니다.</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
</div>
    
@endsection