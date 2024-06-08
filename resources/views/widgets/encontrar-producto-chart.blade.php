<div>
    <canvas id="encontrarProductoChart"></canvas>
    <div class="mt-4">
        <button wire:click="filtrar('Si')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
            Sí
        </button>
        <button wire:click="filtrar('No')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            No
        </button>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('datosFiltrados', function () {
            var ctx = document.getElementById('encontrarProductoChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {!! json_encode($data) !!},
            });
        });
    });
</script>
