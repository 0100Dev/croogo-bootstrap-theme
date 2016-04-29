<?php

namespace CvoTechnologies\Bootstrap\View\Helper;

use Cake\Routing\Router;
use Cake\Utility\Hash;
use Cake\View\Helper;

/**
 * Custom Helper
 *
 */
class CustomHelper extends Helper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js',
		'Layout',
	);

	public function menu($menuAlias, $options = array()) {
		$_options = array(
			'tag' => 'ul',
			'tagAttributes' => array(),
			'selected' => 'active',
			'dropdown' => false,
			'dropdownClass' => 'dropdown',
			'dropdownMenuClass' => 'dropdown-menu',
			'toggle' => 'dropdown-toggle',
			'menuClass' => 'nav navbar-nav',
			'element' => 'menu',
		);
		$options = Hash::merge($_options, $options);

		if (!isset($this->_View->viewVars['menus_for_layout'][$menuAlias])) {
			return false;
		}
		$menu = $this->_View->viewVars['menus_for_layout'][$menuAlias];
		$output = $this->_View->element($options['element'], array(
			'menu' => $menu,
			'options' => $options,
				));
		return $output;
	}

/**
 * Nested Links
 *
 * @param array $links model output (threaded)
 * @param array $options (optional)
 * @param integer $depth depth level
 * @return string
 */
	public function nestedLinks($links, $options = array(), $depth = 1) {
		$_options = array('menuClass' => 'nav-dropdown');
		$options = array_merge($_options, $options);

		$output = '';
		foreach ($links AS $link) {
			$linkAttr = array(
				'id' => 'link-' . $link->id,
				'rel' => $link->rel,
				'target' => $link->target,
				'title' => $link->description,
				'class' => $link->class,
			);

			foreach ($linkAttr AS $attrKey => $attrValue) {
				if ($attrValue == null) {
					unset($linkAttr[$attrKey]);
				}
			}

			// Remove locale part before comparing links
			if (!empty($this->params['locale'])) {
				$currentUrl = substr($this->_View->request->url, strlen($this->params['locale']));
			} else {
				$currentUrl = $this->_View->request->url;
			}

			if (Router::url($link->link->getUrl()) == Router::url('/' . $currentUrl)) {
				if (!isset($linkAttr['class'])) {
					$linkAttr['class'] = '';
				}
				$linkAttr['class'] .= ' ' . $options['selected'];
			}

			$linkOutput = $this->Html->link($link->title, $link->link->getUrl());
			if (isset($link['children']) && count($link['children']) > 0) {
				if (!isset($linkAttr['class'])) {
					$linkAttr['class'] = '';
				}
				$linkOutput = $this->Html->link($link->title . '<b class="caret"></b>', $link['Link']['link'], array('class' => $options['toggle'], 'data-toggle' => $options['dropdownClass'], 'escape' => false));
				$linkAttr['class'] .= ' ' . $options['dropdownClass'];
				$linkOutput .= $this->nestedLinks($link['children'], $options, $depth + 1);
			}
			$linkOutput = $this->Html->tag('li', $linkOutput, $linkAttr);
			$output .= $linkOutput;
		}
		if ($output != null) {
			$tagAttr = $options['tagAttributes'];
			if ($options['dropdown'] && $depth == 1) {
				$tagAttr['class'] = $options['menuClass'];
			}
			if ($depth > 1) {
				$tagAttr['class'] = $options['dropdownMenuClass'];
			}
			$output = $this->Html->tag($options['tag'], $output, $tagAttr);
		}

		return $output;
	}

}
