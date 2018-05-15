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

    public function test_nonceField() {
        Monkey\Functions\expect('wp_nonce_field')->once()->andReturn('<input type="hidden" ...>');
        $this->assertEquals('<input type="hidden" ...>', $this->nonce->nonceField());
    }

    public function test_nonceUrl() {
        Monkey\Functions\expect('wp_nonce_url')->once()->andReturn('http//test.test');
        $this->assertEquals('http//test.test', $this->nonce->nonceUrl('http//test.test'));
    }

    public function test_checkAdminRefererInvalid() {
        Monkey\Functions\expect('check_admin_referer')->once()->andReturn(false);
        $this->assertFalse($this->nonce->checkAdminReferer());
    }

    public function test_checkAdminRefererValid() {
        Monkey\Functions\expect('check_admin_referer')->once()->andReturn(1);
        $this->assertEquals(1, $this->nonce->checkAdminReferer());
    }

    public function test_checkAjaxRefererInvalid() {
        Monkey\Functions\expect('check_ajax_referer')->once()->andReturn(false);
        $this->assertFalse($this->nonce->checkAjaxReferer());
    }

    public function test_checkAjaxRefererValid() {
        Monkey\Functions\expect('check_ajax_referer')->once()->andReturn(1);
        $this->assertEquals(1, $this->nonce->checkAjaxReferer());
    }

    public function tearDown() {
        Monkey\tearDown();
        parent::tearDown();
    }
}