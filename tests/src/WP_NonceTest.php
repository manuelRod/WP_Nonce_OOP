<?php
use manuelRod\WP_Nonce_OOP\WP_Nonce;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

class WP_Nonce_Test extends TestCase {

    public function setUp() {
        parent::setUp();
        Monkey\setUp();
        $this->nonce = new WP_Nonce($this->action);
    }

    /**
     * @var string
     */
    protected $action = 'test_nonce';

    /**
     * @var WP_Nonce
     */
    protected $nonce;

    /**
     * createNonce Test
     */
    public function test_createNonce() {
        Monkey\Functions\expect('wp_create_nonce')->once()->andReturn($this->action);
        $this->assertEquals( $this->action, $this->nonce->createNonce() );
    }

    public function test_verifyNonceFailure() {
        Monkey\Functions\expect('wp_create_nonce')->once()->andReturn($this->action);
        Monkey\Functions\expect('wp_verify_nonce')->once()->andReturn(false);
        $this->assertFalse($this->nonce->verifyNonce($this->nonce->createNonce()));
    }

    public function test_verifyNonceRightLessThan12Hours() {
        Monkey\Functions\expect('wp_create_nonce')->once()->andReturn($this->action);
        Monkey\Functions\expect('wp_verify_nonce')->once()->andReturn(1);
        $this->assertEquals(1, $this->nonce->verifyNonce($this->nonce->createNonce()));
    }

    public function test_verifyNonceRightMoreThan12Hours() {
        Monkey\Functions\expect('wp_create_nonce')->once()->andReturn($this->action);
        Monkey\Functions\expect('wp_verify_nonce')->once()->andReturn(2);
        $this->assertEquals(2, $this->nonce->verifyNonce($this->nonce->createNonce()));
    }

    public function tearDown() {
        Monkey\tearDown();
        parent::tearDown();
    }
}