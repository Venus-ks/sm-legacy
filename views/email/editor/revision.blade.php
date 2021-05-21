@extends('email.main')

@section('content')
    
<h4>
    {{$info['institute_title']}} [{{$info['journal_title']}}] 투고논문 등록 완료 {{$article_id}}
</h4>
<p>편집위원장님</p>
<p>{{ $author }}님이 다음의 논문에 대한 심사결과에 대하여 수정한 원고를 등록하였습니다.</p>
<p style="text-align: center">
    <a href='http://{{$_SERVER['HTTP_HOST']}}/admin/d_sub01_write.php?seq={{ $seq }}' target='_blank'>
        논문접수 등록 페이지로 이동
    </a>
</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>제목 : {{ $title }}</p>
    <p>초록 : {{ $abstract }}</p>
    <p>키워드 : {{ $keyword }}</p>
</p>
    
@endsection