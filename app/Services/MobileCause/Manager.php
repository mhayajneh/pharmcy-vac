<?php
namespace App\Services\MobileCause;

class Manager
{
  /**
   * The Response object.
   *
   * @var Connection
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
   * @param  \GuzzleHttp\Client $client
   * @return void
   */
  public function __construct(Connection $connection, Array $config = null)
  {
    $this->config = $config;
    $this->connection = $connection;
  }





  /**
   * Get the Connection class.
   *
   * @return Connection
   */
  public function getConnection()
  {
    return $this->connection;
  }





  /**
   * Make.
   *
   * @return Factory
   */
  public function make()
  {
    return new Factory($this->connection, $this->config);
  }
}
