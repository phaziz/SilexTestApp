SilexTestApp
============

Using Silex PHP-Framework, Twig Template Engine, Doctrine DBAL, Monolog Logger and SwiftMailer.

	<?php
	
	    require_once __DIR__.'/../vendor/autoload.php';
	
	    $app = new Silex\Application();
	
	    require_once __DIR__.'/../app/routes/routes.php';
	
	    /*
	     * REGISTERING DOCTRINE DBAL START
	     * */
	    $app -> register(new Silex\Provider\DoctrineServiceProvider(),
	        array
	            (
	                'db.options' => array
	                (
	                    'driver'    => 'pdo_mysql',
	                    'host'      => 'XXXXX',
	                    'dbname'    => 'XXXXX',
	                    'user'      => 'XXXXX',
	                    'password'  => 'XXXXX',
	                    'charset'   => 'utf8'
	                )
	            )
	    );
	    /*
	     * REGISTERING DOCTRINE DBAL END
	     * */
	
	    /*
	     * REGISTERING MONOLOG LOGGER START
	     * */
	    $app -> register(new Silex\Provider\MonologServiceProvider(),
	        array
	        (
	            'monolog.logfile' => __DIR__.'/../app/logfiles/' . date('Y-m-d') . '.txt',
	            'monolog.level' => DEBUG
	        )
	    );
	    /*
	     * REGISTERING MONOLOG LOGGER END
	     * */
	
	    /*
	     * REGISTERING SWIFTMAILER START
	     * */
	    $app -> register(new Silex\Provider\SwiftmailerServiceProvider());
	
	    $app['swiftmailer.options'] = array(
	        'host'       => 'smtp.gmail.com',
	        'port'       => 465,
	        'username'   => 'XXXXX@gmail.com',
	        'password'   => 'XXXXX',
	        'encryption' => 'ssl',
	        'auth_mode'  => 'login'
	    );
	    /*
	     * REGISTERING SWIFTMAILER END
	     * */
	
	    /*
	     * REGISTERING TWIG TEMPLATE ENGINE START
	     * */
	    $app -> register(new Silex\Provider\TwigServiceProvider(),
	        array
	        (
	            'twig.path' => __DIR__.'/../app/views/',
	            'twig.options' => array
	            (
	                'debug' => true,
	                'charset' => 'utf-8',
	                'cache' => __DIR__.'/../app/cache/',
	                'auto_reload' => 'true',
	                'strict_variables' => true,
	                'autoescape' => true,
	                'optimizations' => -1
	            )
	        )
	    );
	
	    /*
	     * REGISTERING TWIG TEMPLATE ENGINE END
	     * */
	    
	    $app -> run();