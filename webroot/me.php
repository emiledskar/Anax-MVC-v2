<?php
require __DIR__.'/config_with_app.php';

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

$app->router->add('', function() use ($app) {
 	$app->theme->setTitle("Me-sidan");

    $content = $app->fileContent->get('source.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
    $byline  = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page',[
    	'content' => $content,
        'byline' => $byline,
    ]);
});

$app->router->add('redovisning', function() use ($app) {

    $app->theme->setTitle("Redovisning");
 
    $content = $app->fileContent->get('redovisning.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline  = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page',[
    	'content' => $content,
        'byline' => $byline,
    ]);
});

$app->router->add('source', function() use ($app) {
	$app->theme->setTitle("Source");
	$app->theme->addStylesheet('css/source.css');

    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
});

$app->router->handle();
$app->theme->render();
?>