<?php

Route::get('(:bundle)/(:all?)', function($params = null)
{
	$well = function($header, $code)
	{
		return View::make('artisan::well', array(
			'header' => $header,
			'code'   => $code,
		));
	};

	if (empty($params))
	{
		$examples = array(
			URL::current() . '/bundle+task.method/param',
			URL::current() . '/bundle+task',
			URL::current() . '/task.method',
			URL::current() . '/migrate',
			URL::current() . '/migrate.reset',
		);
		return $well('Try something like this', implode('<br />', $examples));
	}

	$args = str_replace(
		array('+', '.'),
		array('::', ':'),
		explode('/', $params)
	);

	$ret = $well('Equivalent command', 'php artisan ' . implode(' ', $args));

	ob_start();

	try
	{
		require path('sys').'cli/dependencies'.EXT;
		Laravel\CLI\Command::run($args);
	}
	catch (Exception $ex)
	{
		echo $ex->getMessage();
	}

	$output = str_replace(PHP_EOL, '<br />', ob_get_contents());
	ob_end_clean();

	$ret .= $well('Output', $output);

	return $ret;
});