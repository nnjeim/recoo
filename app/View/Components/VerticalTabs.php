<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VerticalTabs extends Component
{
	public $tabs;

	public $activeTab;

	public function __construct($tabs, $activeTab)
	{
		$this->tabs = $tabs;
		$this->activeTab = $activeTab;
	}

	/**
	 * Get the view / contents that represents the component.
	 *
	 * @return \Illuminate\View\View
	 */
	public function render()
	{
		return view('components.form.tabs.vertical.index');
	}
}
