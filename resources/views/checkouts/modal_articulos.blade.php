<div class="modal fade" id="modalArticulos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">📦 Artículos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="text" id="buscador" class="form-control mb-3" placeholder="🔍 Buscar">

                @foreach ($articulos as $a)
                    <div class="d-flex justify-content-between articulo-item mb-2 border rounded p-2">
                        <span>{{ $a->nombre }}</span>
                        <input type="number" class="form-control w-25 cantidad" min="0" value="0"
                            data-id="{{ $a->id }}" data-nombre="{{ $a->nombre }}">
                    </div>
                @endforeach

            </div>

            <div class="modal-footer">
                <button id="btnGuardarArticulos" class="btn btn-success" data-bs-dismiss="modal">
                    ✅ Agregar
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // 🔍 BUSCADOR
        document.getElementById('buscador').addEventListener('keyup', function() {

            let filtro = this.value.toLowerCase();

            document.querySelectorAll('.articulo-item').forEach(item => {
                item.style.display = item.innerText.toLowerCase().includes(filtro) ?
                    '' :
                    'none';
            });

        });

    });
</script>
