<?php defined('SYSPATH') OR die('No direct access allowed.');

class OAuth2_Provider_Google extends OAuth2_Provider {

	public $name = 'google';

	public function url_authorize()
	{
		return 'https://accounts.google.com/o/oauth2/auth';
	}

	public function url_access_token()
	{
		return 'https://accounts.google.com/o/oauth2/token';
	}

	public function access_token(OAuth2_Client $client, $code, array $params = NULL)
	{
		$request = OAuth2_Request::factory('token', 'POST', $this->url_access_token(), array(
			'grant_type'    => 'authorization_code',
			'code'          => $code,
			'client_id'     => $client->id,
			'client_secret' => $client->secret,
		));

		if ($client->callback)
		{
			$request->param('redirect_uri', $client->callback);
		}

		if ($params)
		{
			// Load user parameters
			$request->params($params);
		}
		$request->format('json');
		
		$response = $request->execute();
		
		return OAuth2_Token::factory('access', array(
			'token' => $response->param('access_token')
		));
	}

	public function get_tokens(OAuth2_Client $client, $code, array $params = NULL)
	{
		$request = OAuth2_Request::factory('token', 'POST', $this->url_access_token(), array(
			'grant_type'    => 'authorization_code',
			'code'          => $code,
			'client_id'     => $client->id,
			'client_secret' => $client->secret,
		));

		if ($client->callback)
		{
			$request->param('redirect_uri', $client->callback);
		}

		if ($params)
		{
			// Load user parameters
			$request->params($params);
		}
		$request->format('json');

		return $request->execute();
	}

	public function access_profile( $token )
	{
		$graph_url = "https://www.googleapis.com/oauth2/v1/userinfo";
		
		$request = OAuth2_Request::factory('data', 'GET', $graph_url, array(
                                                'access_token'    => $token,
						'alt'		  => 'json',
                                        ))->execute();
			
		return $response = JSON::decode($request);
	}
	
}
