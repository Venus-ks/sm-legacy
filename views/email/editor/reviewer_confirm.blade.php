@extends('email.main')

@section('content')
    
<p>편집위원장님께</p>
<p>아래 논문이 심사승인 되었습니다.</p>
<div style="padding:1rem;">
    <h6>Reviewer</h6>
    <p>Name : {{ $name }}</p>
</div>
<p style="text-align: center">
    <a href='{{ $sm_url }}{{ $add_url }}' target='_blank'>
        Reviewer 선정페이지로
    </a>
</p>
    
@endsection