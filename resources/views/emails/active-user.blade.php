@component('mail::message')
#فعالسازی 
@component('mail::button', ['url'=> route('activation.account',$code)])

@endcomponent
@endcomponent