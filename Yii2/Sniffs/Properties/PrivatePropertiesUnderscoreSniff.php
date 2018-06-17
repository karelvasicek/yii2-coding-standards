<?php

namespace PHP_CodeSniffer\Standards\Yii2\Sniffs\Properties;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class Yii2_Sniffs_Properties_PrivatePropertiesUnderscoreSniff implements Sniff
{
	public function register()
	{
		return array(
			T_PRIVATE,
		);
	}

	public function process(File $file, $pointer)
	{
		$tokens = $file->getTokens();
		if ($tokens[$pointer]['content'] === 'private' &&
			$tokens[$pointer + 1]['type'] === 'T_WHITESPACE' &&
			$tokens[$pointer + 2]['type'] === 'T_VARIABLE' &&
			strpos($tokens[$pointer + 2]['content'], '$_') !== 0) {
			$file->addError('Private property name must be prefixed with underscore.', $pointer);
		}
	}
}
