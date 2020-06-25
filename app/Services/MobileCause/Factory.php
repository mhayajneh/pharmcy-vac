<?php
namespace App\Services\MobileCause;

use App\Setting;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Services\MobileCause\Connection;

class Factory
{
  /**
   * Authenticated Guzzle Http client
   *
   * @var App\Services\MobileCause\Connection
   */
  protected $connection;
  /**
   * The necessary configurations.
   *
   * @var Array
   */
  protected $config = [];

  /**
   * Construct a connection class.
   *
   * @param  App\Services\MobileCause\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection, Array $config = null)
  {
    $this->config = $config;
    $this->connection = $connection;
  }





  /**
   * Get the Connection for the request.
   *
   * @return App\Services\MobileCause\Connection
   */
  public function getConnection()
  {
    return $this->connection;
  }





  /**
   * Make a request for transactions
   *
   * @return Array
   */
  public function requestTransactions()
  {
    $this->connection
      ->setPath('reports/transactions.json')
      ->setQuery([
        'status' => 'collected,pending',
        'transaction_type' => 'sale',
        'campaign' => $this->config['campaign_name'],
        'start_date' => $this->config['campaign_start_date'],
        'end_date' => $this->config['campaign_end_date']
      ]);

    return $this->connection->connect();
  }





  /**
   * Get a report by ID.
   *
   * @param Int $id
   * @return Array
   */
  public function getReport(int $id)
  {
    $this->connection
      ->setPath('reports/results.json')
      ->setQuery([
        'id' => $id
      ]);

    return $this->connection->connect();
  }
}
