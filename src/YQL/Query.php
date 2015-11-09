<?php
namespace Yql;

/**
 * Description of YQL
 *
 * @author Maurice Prosper <maurice.prosper@ttu.edu>
 * @package YQL
 */

abstract class Query {
	/**
	 * URL for the YQL API
	 */
	const API = 'https://query.yahooapis.com/v1/public/yql';

	/**
	 * Maker of API calls
	 * @var \Pest
	 */
	private static $pest;

	/**
	 * Runs the Query against Yahoo's Database
	 *
	 * @param string $q the query to run
	 * @return Result
	 */
	public static function execute($q) {
		if(!isset(self::$pest))
			$p = new \Pest(self::API);

		$json = $p->get('', [
			'q'				=> $q,
			'format'		=> 'json',
			'diagnostics'	=> false,
			'env'			=> 'http://datatables.org/alltables.env',
		]);

		return new Result($json);
	}
}