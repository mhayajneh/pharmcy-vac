<?php
namespace App\Services\MobileCause;

use Carbon\Carbon;
use GuzzleHttp\Client;

class Connection
{
  /**
   * Authenticated Guzzle Http client
   *
   * @var GuzzleHttp\Client
   */
  protected $client;
  /**
   * The Response object.
   *
   * @var Response
   */
  protected $response;
  /**
   * The Request Path.
   *
   * @var String
   */
  protected $path = '';
  /**
   * The Request Path.
   *
   * @var Array
   */
  protected $query = [];

  /**
   * Construct a connection class.
   *
   * @param  \GuzzleHttp\Client $client
   * @return void
   */
  public function __construct(String $token)
  {
    $this->client = new Client([
      'base_uri' => 'https://app.mobilecause.com/api/v2/',
      'headers' => [
        'Accept' => 'application/json',
        'Authorization' => 'Token token="' . $token . '"'
      ],
      'http_errors' => false,
      'verify' => true,
      'allow_redirects' => false
    ]);
  }





  /**
   * Get the Guzzle client for the request.
   *
   * @return GuzzleHttp\Client
   */
  public function getClient()
  {
    return $this->client;
  }
  /**
   * Get the request path.
   *
   * @param String $path
   * @return Self
   */
  public function setPath(String $path)
  {
    $this->path = $path;
    return $this;
  }
  /**
   * Get the request query data
   *
   * @param Array $query
   * @return Self
   */
  public function setQuery(Array $query)
  {
    $this->query = $query;
    return $this;
  }
  /**
   * Get the request path.
   *
   * @return String
   */
  public function getPath()
  {
    return $this->path;
  }
  /**
   * Get the request query data
   *
   * @return Array
   */
  public function getQuery()
  {
    return $this->query;
  }




  /**
   * Connect.
   *
   * @return Response
   */
  public function connect()
  {
    $response = $this->client->request('GET', $this->getPath(), ['query' => $this->GetQuery()]);

    if( $response->getStatusCode() == '200' )
    {
      $response = json_decode($response->getBody());

      return new Response($response);
    }

    dd('Problem');
  }
}
