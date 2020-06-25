<?php
namespace App\Services\MobileCause;

class Response
{
  /**
   * The Response data.
   *
   * @var Object
   */
  protected $data;





  /**
   * Construct a connection class.
   *
   * @param  mixed $data
   * @return void
   */
  public function __construct($data)
  {
    $this->data = $data;
  }





  /**
   * Get the response data.
   *
   * @return Object
   */
  public function getData()
  {
    return $this->data;
  }





  /**
   * Make.
   *
   * @return Factory
   */
  public function isComplete()
  {
    return is_array($this->data);
  }
}
