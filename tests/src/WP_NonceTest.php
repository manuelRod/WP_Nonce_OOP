<?php

use PHPUnit\Framework\TestCase;
use manuelRod\WP_Nonce_OOP\WP_Nonce;

class WP_Nonce_Test extends TestCase {

    public function testConstructor() {
        $generator = new WP_Nonce('action');

    }

}