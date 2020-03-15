<?php
/**
 * @author Timon Kreis <mail@timonkreis.de>
 * @copyright 2020 Timon Kreis
 * @license http://www.opensource.org/licenses/mit-license.html
 */
defined('TYPO3_MODE') || die('Access denied.');

if (!function_exists('tk_group_fields')) {
	function tk_group_fields(array &$tableTCA, array $fields, string $paletteName = null, string $label = null) : void {
		if ($paletteName === null) {
			$paletteName = uniqid();
		}

		// Create palette
		$tableTCA['palettes'][$paletteName]['showitem'] = implode(', ', $fields);

		if ($label) {
			$tableTCA['palettes'][$paletteName]['label'] = $label;
		}

		$paletteInserted = false;
		$availableFields = array_map('trim', explode(',', $tableTCA['types']['1']['showitem']));
		$filteredFields = [];

		foreach ($availableFields as $field) {
			if (in_array($field, $fields)) {
				if (!$paletteInserted) {
					$filteredFields[] = '--palette--;;' . $paletteName;
					$paletteInserted = true;
				}
			}
			else {
				$filteredFields[] = $field;
			}
		}

		$tableTCA['types']['1']['showitem'] = implode(', ', $filteredFields);
	}
}
