@extends('email.main')

@section('content')
    
<div style="word-wrap: break-word; word-break: break-all;">
    <h4>
        Paper Submission Modified
    </h4>
    <p>
        {{ $mb_name }} modified
    </p>
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
</div>
    
@endsection