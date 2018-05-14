<?php

namespace manuelRod\WP_Nonce_OOP;

class WP_Nonce {

    protected $action;


    function __construct($action = -1) {
        $this->action = $action;
    }

}