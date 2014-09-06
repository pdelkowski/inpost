<?php

class HomeController extends BaseController {

	public function showHome() {
		return InpostApi::getInpostApi();
	}

}