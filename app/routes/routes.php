<?php

    use Symfony\Component\HttpFoundation\Response;

    $app -> error(function (\Exception $e, $code)
        {
            return new Response('We are sorry, but something went terribly wrong.');
        }
    );

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
                     -> setFrom(array('XXXXX@gmail.com'))
                     -> setTo(array('XXXXX@gmail.com'))
                     -> setBody('SwiftMailer works...');
            $app['mailer'] -> send($message);
            */

            $SQL  = "SELECT * FROM test;";
            $TEST_DATA = $app['db'] -> prepare($SQL);
            $TEST_DATA -> execute();

            //$app['twig'] -> addFilter('var_dump', new Twig_Filter_Function('var_dump'));

            return $app['twig'] -> render('testdata.twig',
                array
                (
                    'TEST_DATA' => $TEST_DATA,
                )
            );
        }
    );