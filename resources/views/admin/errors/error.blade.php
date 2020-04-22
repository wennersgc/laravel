@if (isset($errors) && count($errors))

Erros: {{count($errors->all())}} Error(s)
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }} </li>
    @endforeach
</ul>

@endif
