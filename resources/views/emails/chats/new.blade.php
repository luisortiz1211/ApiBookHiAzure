@component('mail::message')
# Hola {{$chat->user2->name}}
## {{$chat->user1->name}} ha preguntado por uno de tus libros.
@component('mail::button', ['url' => URL::to('/')])
    Ir al Chat
@endcomponent
@endcomponent
