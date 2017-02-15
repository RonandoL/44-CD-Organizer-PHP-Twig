<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cd.php";

    session_start();
    if (empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
  // End Red Tape

    // 1. Route for home page
    $app->get('/', function() use ($app) {
        return $app['twig']->render('cds.html.twig', array('cds' => $_SESSION['list_of_cds']));
    });

    // 2. POST INSTANTIATE Route for sending new object (new task) to /new-cd URL
    $app->post('/new-cd', function() use ($app) {
        $cd = new Cd(ucwords($_POST['title']), ucwords($_POST['artist']));
        $cd->save();

        return $app['twig']->render('cds.html.twig', array('cds' => $_SESSION['list_of_cds']));
    });

    // LIST ARTISTS
    $app->get('/artists', function() use ($app) {
        $_SESSION['list_of_artists'] = array();
        foreach ($_SESSION['list_of_cds'] as $cd) {
          $artist = $cd->getArtist();
          array_push($_SESSION['list_of_artists'], $artist);
        }
        return $app['twig']->render('cds.html.twig', array('artists' => $_SESSION['list_of_artists']));
    });

    // 3. Route for deleting all tasks
    $app->post('/', function() use ($app) {
        Cd::deleteAll();
        return $app['twig']->render('cds.html.twig');
    });

    return $app;

?>
