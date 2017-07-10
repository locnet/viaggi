
<p>Gracias por registrate {{ ucwords($user->name) }},</p>
<p>para terminar el registro haz clik en el siquiente enlace:</p>
<p><a href="{{ url('get-confirmation/'.$user->confirmation_code) }}">Enlace</a></p>