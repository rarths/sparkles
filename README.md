Sparkles, a PHP class for flashing messages in your Anax
==================================

Background
----------------------------------
Made this modul as a assignment in the PHPMVC course at BTH. The module is inspired by the flash class used in the [Phalcon framework](http://docs.phalconphp.com/en/latest/api/Phalcon_Flash.html). Messages are stored in sessions to stay alive during redirects.

Install
----------------------------------
- Install [packagist](https://packagist.org/packages/rarths/csparkles) via composer or clone it directly to your project and make sure csparkles autoloads.

- Add Sparkles as a service to your project through the Dependency Injection and make sure you start the session.
```php
$di->set('sparkles', function () use ($di) {
    $sparkles = new \Rarths\Sparkles\CSparkles();
    $sparkles->setDI($di);
    return $sparkles;
});
```

- Include the flash.css to your CSS setup or use your own CSS classes.
```php
$di->set('sparkles', function () use ($di) {
    $sparkles = new \Rarths\Sparkles\CSparkles(array(
    	'error' 	=> 'error-message',
    	'success' 	=> 'success-message',
    	'notice' 	=> 'notice-message',
	));
    $sparkles->setDI($di);
    return $sparkles;
});
```

- Change your existing error messages with this line.
```php
$app->sparkles->flash('error', 'Oh sparkles! Have to watch out somewhere..');
```

- To output messages, put this in your view.
```php
$messages = $this->sparkles->output();
if (!empty($message)) {
	echo '<div class="top-flash">';
	foreach ($messages as $key => $message) {
		echo $message;
	}
	echo '</div>';
}
```

Extra
----------------------------------
If you are using the default top-flash its a good idea to put the ouput in your footer.
In that way you make sure you're not excluding any flashing messages.

The messages is using CSS3 Animations and are not supported by IE -9.

By Robin Hansson (robin@rarths.net)



License
----------------------------------

This software is free software and carries a MIT license.



Todo
----------------------------------

* Get started ;)


History
----------------------------------

v1.0


```
 .   
..:  Copyright 2015 by Robin Hansson robin@rarths.net)
```
