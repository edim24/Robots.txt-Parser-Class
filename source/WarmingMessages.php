<?php declare(strict_types=1);

namespace t1gor\RobotsTxtParser;

abstract class WarmingMessages {
	const STRING_INIT_DEPRECATE = 'Please consider initializing parser with a stream, strings would be deprecated soon.';

	const ENCODING_NOT_UTF8 = 'Encoding you are passing is different from UTF-8. '
		. 'Google might be ignoring some parts of the file.'
		. 'See https://developers.google.com/search/reference/robots_txt#file-format for more info.';
}
