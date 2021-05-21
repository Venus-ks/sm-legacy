@extends('email.main')

@section('content')
    
<h4>{{$info['institute_title']}} 최종논문 검토 완료 {{ $article_id }}</h4>
<p>{{$mb_name}} 저자님께</p>
<p>안녕하세요?</p>
<p>&nbsp; 본 학회 {{$info['institute_title']}}에 {{$mb_name}}님이 투고한 원고의 심사결과가 편집위원장님에 의해 ‘수정후 재심사’로 최종논문 검토가 완료되었습니다.</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
</div>
    
@endsection