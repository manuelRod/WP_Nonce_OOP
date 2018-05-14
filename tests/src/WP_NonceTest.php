<?php
use manuelRod\WP_Nonce_OOP\WP_Nonce;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

class WP_Nonce_Test extends TestCase {

    public function setUp() {
        parent::setUp();
        Monkey\setUp();
    }

    protected $action = 'test_nonce';



    public function tearDown() {
        Monkey\tearDown();
        parent::tearDown();
    }
}