<?php

namespace ApiChannel\dto\web\builder;

use ApiChannel\common\Constant;
use ApiChannel\dto\web\WebResponse;

class WebResponseBuilder
{
    public $status = Constant::HTTP_200_VAL;
    public $message = Constant::HTTP_200_NAME;
    public $data = "";

    /**
     * Set the value of status
     */
    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set the value of message
     */
    public function setMessage($message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Set the value of data
     */
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }

        
    /**
     * Method build
     * @return WebResponse
     */
    public function build()
    {
        return new WebResponse(
            $this->status,
            $this->message,
            $this->data
        );
    }
    
}