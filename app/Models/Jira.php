<?php
/**
 * Created by PhpStorm.
 * User: MMalley
 * Date: 2018-05-24
 * Time: 11:21 AM
 */

namespace App\Models;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;
use GuzzleHttp\Client;

class Jira
{
	protected $client;

	public function __construct()
	{

//		$this->client = new Client([
//			'auth' => [
//				'blueprint', 'tLrRbLeHwXfD6yULWRiomF6VQLdtvYW43JekYFfzHjyo'
//			],
//			'base_uri' => 'jira.malleyindustries.com:8080/rest/api/2/',
//			"headers" =>
//				[
//					"Accept" => "application/json",
//					"Content-type" => "application/json"
//				],
//		]);
	}

	/**
	 * @return array
	 */
	public function myself()
	{
		$res = $this->client->get( 'myself' );
		return json_decode( $res->getBody() );
	}


	public function error()
    {
        Bugsnag::notifyException(new RuntimeException("Test error"));
        return "error message";
    }

	/**
	 * @param array $array
	 * @return array
	 */
	private function wrapJson( array $array ): array
	{
		return ["json"=>$array];
	}

	/**
	 * @param string $option
	 * @param bool $exact
	 * @return mixed
	 */
	public function searchByOptionNumber( string $option, bool $exact = false )
	{
		$query = ($exact) ? "cf[10100] ~ '{$option}'" : "cf[10100] ~ '{$option}*'";

		$payload = [
			"jql" => $query,
			"startAt" => 0,
			"maxResults" => 15,
			"fields" =>
			[
				"summary",
				"status",
				"assignee",
				"customfield_10100",
			]
		];

		$res = $this->client->post( 'search', $this->wrapJson($payload) );

		return json_decode( $res->getBody() );
	}
}
