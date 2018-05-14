<?php

namespace manuelRod\WP_Nonce_OOP;

/**
 * Wraps wp_nonce_* functionality on WP_Nonce Class.
 *
 * Class WP_Nonce
 * @package manuelRod\WP_Nonce_OOP
 */
class WP_Nonce {

    /**
     * Action name. Should give the context to what is taking place.
     *
     * @var int|string
     */
    protected $action;

    /**
     * WP_Nonce constructor.
     * @param int $action
     */
    public function __construct($action = -1) {
        $this->action = $action;
    }


    /**
     * Generates and returns a nonce.
     * The nonce is generated based on the current time, $this->action argument, and the current user ID.
     *
     * @return string
     */
    public function createNonce() {
        return wp_create_nonce($this->action);
    }

    /**
     * Verify if nonce is correct.
     * Returns:
     * false if not valid.
     * 1 – if the nonce has been generated in the past 12 hours or less.
     * 2 – if the nonce was generated between 12 and 24 hours ago.
     * @param $nonce
     * @return false|int
     */
    public function verifyNonce($nonce) {
        return wp_verify_nonce($nonce, $this->action);
    }





}