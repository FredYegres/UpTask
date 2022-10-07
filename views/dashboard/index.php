<?php include_once __DIR__ . '/header-dashboard.php'; ?>

    <?php if(count($proyectos) === 0) { ?>
        <p class="no-proyectos">No Hay Proyectos Aún <a href="/crear-proyecto">Empieza a crear uno ahora</a></p>

    <?php } else { ?>
        <ul class="listado-proyectos">
            <?php foreach ($proyectos as $proyecto) { ?>
                <li>
                    <a class="proyecto" href="/proyecto?url=<?php echo $proyecto->url; ?>">
                        <?php echo $proyecto->proyecto; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
   

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>