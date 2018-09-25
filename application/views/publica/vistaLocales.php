<h1>Lista de locales:</h1>

<div class="container">
    <div class="row">
        <?php foreach ($locales as $key => $value): ?>

            <div class="col">
                 <ul class="list-group">
                    <li class="list-group-item"><h1>Local <?php echo($key+1) ?></h1></li>
                    <li class="list-group-item">Direccion: <?php echo($locales[$key]['direccion']) ?></li>
                    <li class="list-group-item">Telefono: <?php echo($locales[$key]['telefono']) ?></li>
                    <li class="list-group-item">Horario: <?php echo($locales[$key]['horario']) ?></li>
                </ul>
            </div>
        <?php endforeach; ?>

    </div>
</div>

