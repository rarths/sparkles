Sparkles, a PHP class for flashing messages in your Anax
==================================

Background
----------------------------------
Made this modul as a assignment in the PHPMVC course at BTH. The module is inspired by the flash class used in the [Phalcon framework](http://docs.phalconphp.com/en/latest/api/Phalcon_Flash.html). Messages are stored in sessions to stay alive during redirects.

Install
----------------------------------
- Install through [packagist](https://packagist.org/packages/rarths/csparkles) via composer (recomended) or clone it directly to your project. If you choose to clone it, make sure csparkles.php autoloads.

- Add Sparkles as a service to your project through the Dependency Injection and make sure session is started.
```php
$di->set('sparkles', function () use ($di) {
    $sparkles = new \Rarths\Sparkles\CSparkles();
    $sparkles->setDI($di);
    return $sparkles;
});
```

- Include the flash.css to your CSS setup or use your own CSS classes. Read extras for IE support. For custom CSS classes add 'error', 'success', 'notice' as parameters to Sparkles. Leave empty for default values.
```php
$di->set('sparkles', function () use ($di) {
    $sparkles = new \Rarths\Sparkles\CSparkles(array(
    	'error' 	=> 'custom-error-message-class',
    	'success' 	=> 'custom-success-message-class',
    	'notice' 	=> 'custom-notice-message-class',
	));
    $sparkles->setDI($di);
    return $sparkles;
});
```

- Add a message to be flashed with this line:
```php
$app->sparkles->flash('error', 'Oh sparkles! You have to watch out somewhere..');
```

- To output messages, put this in your view.
```php
$messages = $this->sparkles->output();
if (!empty($messages)) {
	echo '<div class="top-flash">';
	foreach ($messages as $key => $message) {
		echo $message;
	}
	echo '</div>';
}
```

Extra
----------------------------------
- If you are using the default top-flash its a good idea to put the ouput in your footer.
In that way you make sure you're not excluding any flashing messages.

- Messages is using CSS3 Animations to be gone in 5s. CSS3 Animations is supported by IE 10+.

- Messages will look like [this](http://www.student.bth.se/~roha15/phpmvc/kmom05/webroot/sparkles)

- Problems? Feel free to contact me (in Swedish or English)

By Robin Hansson (robin@rarths.net)



License
----------------------------------

This software is free software and carries a MIT license.



Todo
----------------------------------

* Get started ;)


History
----------------------------------

v2.0 Added PHPUnit testing


```
 .   
..:  Copyright 2015 by Robin Hansson robin@rarths.net)
```
