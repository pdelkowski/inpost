<?php

namespace Repositories\InpostApi;

use \stdClass;

class InpostApiRepository extends \Repositories\BaseRepository implements InpostApiInterface, \Robbo\Presenter\PresentableInterface {

	use \KirkBushell\Fatty\Context;

	/**
	 * Returns the instance of Inpost API
	 * 
	 * @return stdClass
	 */
	public function getInstance() {
		echo 'I got the instance';
		die;
	}

	/**
	 * Returns all user's packages
	 * 
	 * @return \Collection
	 */
	public function getPackages() {
		echo 'I got your packages';
	}

	/**
	 * Returns stdClass object of Inpost API, data-source may change we return an object of the same format
	 */
	protected function convertFormat($inpostApi) {
		// return $inpostApi ? (object) $inpostApi->toArray() : null;
		return $inpostApi;
	}

	/**
     * Return a created presenter.
     *
     * @return Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new \Presenter\InpostApiPresenter($this);
    }

}