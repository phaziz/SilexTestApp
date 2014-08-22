<?php

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



    /*
     * 
     * ERROR 
     * 
     * */
    $app -> error(function (\Exception $e, $code) use ($app)
        {
            $templates = array
            (
                'errors/'.$code.'.html',
                'errors/'.substr($code, 0, 2).'x.html',
                'errors/'.substr($code, 0, 1).'xx.html',
                'errors/default.html',
            );

            return new Response($app['twig'] -> resolveTemplate($templates) -> render(array('CODE' => $code)), $code);
        }
    );
    /*
     * 
     * ERROR 
     * 
     * */



    /*
     * 
     * MAIN ROUTE 
     * 
     * */
    $app -> get('/', function () use ($app)
        {
            /*
             * Testing Monolog
             * 
            $app['monolog'] -> addInfo('Route /');
            */
            
            /*
             * Testing SwiftMailer
             * 
            $message = \Swift_Message::newInstance()
                     -> setSubject('SwiftMailer Test')
                     -> setFrom(array('phaziz@gmail.com'))
                     -> setTo(array('phaziz@gmail.com'))
                     -> setBody('SwiftMailer works...');
            $app['mailer'] -> send($message);
            */

            $TITLE = 'Welcome @ SilexTestApp';
            $SQL  = "SELECT * FROM test;";
            $TEST_DATA = $app['db'] -> prepare($SQL);
            $TEST_DATA -> execute();

            //$app['twig'] -> addFilter('var_dump', new Twig_Filter_Function('var_dump'));

            return $app['twig'] -> render('index.html',
                array
                (
                    'TEST_DATA' => $TEST_DATA,
                    'TITLE' => $TITLE
                )
            );
        }
    );
    /*
     * 
     * MAIN ROUTE 
     * 
     * */



    /*
     * 
     * Hello {{ NAME }} ROUTE 
     * 
     * */
    $app -> get('/hello/{name}', function ($name) use ($app)
        {
            $NAME = $app -> escape($name);
            $TITLE = 'Hello ' . $NAME . ' - Welcome @ SilexTestApp';

            return $app['twig'] -> render('name.html',
                array
                (
                    'NAME' => $NAME,
                    'TITLE' => $TITLE
                )
            );
        }
    );
    /*
     * 
     * Hello {{ NAME }} ROUTE 
     * 
     * */

   
   
    /*
     * 
     * Hello {{ $_GET['name'] }} ROUTE 
     * 
     * */
    $app -> get('/hello', function (Silex\Application $app, Symfony\Component\HttpFoundation\Request $request)
        {
            $NAME = $app -> escape($request -> get('name')); 
            $TITLE = 'Hello ' . $NAME . ' - Welcome @ SilexTestApp';

            return $app['twig'] -> render('name_get.html',
                array
                (
                    'NAME' => $NAME,
                    'TITLE' => $TITLE
                )
            );
        }
    );
    /*
     * 
     * Hello {{ $_GET['name'] }} ROUTE 
     * 
     * */