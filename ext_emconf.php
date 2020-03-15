<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright 2020 Timon Kreis
 * @license http://www.opensource.org/licenses/mit-license.html
 *
 * @var string $_EXTKEY
 */
$EM_CONF[$_EXTKEY] = [
	'title' => 'TK Helper',
	'description' => '',
	'category' => 'misc',
	'author' => 'Timon Kreis',
	'author_email' => 'mail@timonkreis.de',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '1.0.0',
	'constraints' => [
		'depends' => [
			'typo3' => '9.5.0-9.5.99'
		],
		'conflicts' => [],
		'suggests' => []
	]
];
