@extends('email.main')

@section('content')
    
<h4>
    {{$info['journal_title']}} Reviewer 추천의뢰
</h4>
<p>To {{ $name }} Reviewer</p>
<p>&nbsp;아래와 같이 본 학회 {{$info['institute_title']}}지에 투고된 논문에 대해 편집위원장께서 귀하를 추천해 주셨으며, 이에 귀하에게 심사의뢰를 요청 드립니다. 귀하의 수락여부를 가능한 빨리 알려 주시기 바랍니다. 이 작업을 수행하시려면 온라인투고시스템에 registration하신 후 로그인 하거나, 아래 링크를 클릭하신 후 작업을 진행하시기 바랍니다.</p>
<p>
    심사마감일자 : <strong>
        {{ $expired }}
    </strong>
</p>
<p style="text-align: center">
    <a href='{{ $info['site'] }}{{ $add_url }}' target='_blank'>
        논문심사수락여부확인
    </a>
</p>
<p>
    <strong>
        {{ $add_msg }}
    </strong>
</p>
<p>{{$info['journal_title']}}가 수준 높은 학술지가 될 수 있도록 당신의 현재 및 향후 참여에 대해 감사드립니다.</p>
<div style="padding:1rem;">
    <h6>Article Details</h6>
    <p>Title : {{ $title }}</p>
    <p>Abstract : {{ $abstract }}</p>
</div>
    
@endsection