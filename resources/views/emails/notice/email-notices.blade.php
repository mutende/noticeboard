@component('mail::message')
<p>Dear {{ $name}},</p>
<p>{{ $data[1] }}</p>
<footer><i>Notice valid before {{$data[2]}}</i></footer>
@endcomponent
