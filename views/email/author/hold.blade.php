@extends('email.main')

@section('content')
    
<p>안녕하세요?</p>
<p>&nbsp;귀하가 투고하여주신 논문이 아래의 이유로 인해서 접수가 보류되었습니다. 내용 확인 후 재접수 부탁드립니다.</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
    <p>Reason for hold : {{ $reason }}</p>    
</div>
    
@endsection