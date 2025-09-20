    <?php

    use CodeIgniter\Router\RouteCollection;

    /**
     * @var RouteCollection $routes
     */
    $routes->get('/', 'Home::index');
    $routes->get('/reporte/filtro', 'ReporteController::index');
    $routes->get('/reporte/search', 'ReporteController::search');
    $routes->get('/reporte/filtro/pdf', 'ReporteController::getReport');
