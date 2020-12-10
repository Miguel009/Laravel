@component('mail::message')
# Bienvenido Usuario!

Hola compañero gracias por registrate

@component('mail::button', ['url' => 'http://localhost:8000/'])
Ir a la Accion!
@endcomponent

Gracias,<br>
Miguel
@endcomponent
