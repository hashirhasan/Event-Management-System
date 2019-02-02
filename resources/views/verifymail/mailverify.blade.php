hello {{$user->organisation}}
please verify ur email by clicking on the link below
{{route('verify',$user->verificationtoken)}}
