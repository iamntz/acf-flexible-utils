<?php

namespace ntz\acf;

class FlexibleContentProperties
{
	private $pluginPath;

	public function __construct($pluginPath)
	{
		$this->pluginPath = $pluginPath;

		add_filter('admin_enqueue_scripts', array($this, 'enqueueScripts'));
		add_filter('acf/prepare_field', array($this, 'addFlexibleContentRenamer'));
		add_filter('acf/prepare_field', array($this, 'tweakInstructions'));
	}

	public function enqueueScripts()
	{
		wp_register_script( 'acf_flexible_utils', plugin_dir_url($this->pluginPath) . 'assets/acf-flexible-utils.js', array(), 1, true );
		wp_enqueue_script('acf_flexible_utils');

		wp_enqueue_style('acf_flexible_utils', plugin_dir_url($this->pluginPath) . 'assets/acf-helpers.css');
	}

	public function addFlexibleContentRenamer($field)
	{

		if ($field['type'] == 'flexible_content') {
			array_walk($field['layouts'], function (&$layout, $key) {
				$extraFields = array();
				$extraFields[] = '<span class="js-acf-fc-layout-title"></span>';
				$extraFields[] = '<span class="js-acf-fc-layout-type"></span>';
				$extraFields[] = '<span class="js-acf-fc-layout-disabled"></span>';
				$layout['label'] = sprintf('%s%s', $layout['label'], implode('', $extraFields));
			});
		}

		return $field;
	}

	public function tweakInstructions($field)
	{
		if (empty($field['instructions'])) {
			return $field;
		}

		if (substr($field['instructions'], 0, 1) == '?') {
			$instructions = force_balance_tags(substr($field['instructions'], 1));
			$field['instructions'] = sprintf(' <span class="acf-custom-help">?<span class="acf-custom-help-tooltip">%s</span></span>', $instructions);
			if (!empty($field['label'])) {
				$field['label'] .= $field['instructions'];
				$field['instructions'] = '';
			}
		}

		$field['instructions'] = str_replace('{{THEME_PATH}}', get_stylesheet_directory_uri(), $field['instructions']);
		return $field;
	}
}
