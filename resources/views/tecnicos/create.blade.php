<h4>Técnicos</h4>

<form method="POST" action="{{ route('tecnicos.store') }}">
    @csrf
    <input name="nombre" placeholder="Nombre" required>
    <input name="email" placeholder="Email">
    <button>Agregar</button>
</form>

<table class="table">
    @foreach ($tecnicos as $t)
        <tr>
            <td>{{ $t->nombre }}</td>
            <td>{{ $t->activo ? 'Activo' : 'Inactivo' }}</td>
            <td>
                <form method="POST" action="{{ route('tecnicos.toggle', $t->id) }}">
                    @csrf
                    <button>Cambiar</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
