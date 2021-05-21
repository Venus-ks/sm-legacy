@extends('email.main')

@section('content')
    
<p>{{$info['institute_title']}} [{{$info['journal_title']}}] 논문 최종결과 registration 완료 {{ $article_id }}</p>
<p>{{$name}} 저자님께</p>
<p>안녕하세요?</p>
<p>{$info['journal_title']} 학회지 편집위원회입니다.</p>
<p>보내주신 (수정)원고를 바탕으로 <{{$info['journal_title']}} 제{{$vol}}권 {{$no}}호>를 제작 진행하겠습니다. 그 동안 수고 많으셨습니다.</p>
<br>
<p>수정 검토 및 편집된 최종 논문은 ‘{$info['journal_title']} 온라인투고시스템({{$title}})’에서 열람 가능합니다.</p>
<br/>
<p>앞으로도 저희 학회지에 지속적인 관심과 참여를 부탁드립니다. 감사합니다.</p>
    
@endsection