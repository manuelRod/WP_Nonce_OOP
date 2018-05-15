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

    /**
     * The nonce field is used to validate that the contents of the form request came from the current site and not somewhere else.
     * A nonce does not offer absolute protection, but should protect against most cases.
     * It is very important to use nonce fields in forms.
     *
     * @param string $name    Nonce name. This is the name of the nonce hidden form field to be created. Once the form is submitted, you can access the generated nonce via $_POST[$name].
     * @param bool $referrer  Whether also the referer hidden form field should be created with the wp_referer_field() function.
     * @param bool $echo      Whether to display or return the nonce hidden form field, and also the referer hidden form field if the $referer argument is set to true.
     * @return string
     */
    public function nonceField($name = '_wpnonce', $referrer = true, $echo = true) {
        return wp_nonce_field($this->action, $name, $referrer, $echo);
    }

    /**
     * Retrieve URL with nonce added to URL query.
     *
     * @param string $url   URL to add nonce action
     * @param string $name  Nonce name
     * @return string       The returned result is escaped for display.
     */
    public function nonceUrl($url, $name = '_wpnonce') {
        return wp_nonce_url($url, $this->action, $name);
    }

    /**
     * Makes sure that a user was referred from another admin page.
     *
     * @param string $name Optional. Key to check for nonce in `$_REQUEST` (since 2.5).
     *                              Default '_wpnonce'.
     * @return false|int   False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                     0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
     */
    public function checkAdminReferer($name = '_wpnonce') {
        return check_admin_referer($this->action, $name);
    }

    /**
     * Verifies the Ajax request to prevent processing external requests.
     *
     * @param false|string $name  Optional. Key to check for the nonce in `$_REQUEST`. If false,
     *                            `$_REQUEST` values will be evaluated for '_ajax_nonce', and '_wpnonce'
     * @param bool         $die   Optional. Whether to die early when the nonce cannot be verified.
     * @return false|int          False if the nonce is invalid, 1 if the nonce is valid and generated between
     *                            0-12 hours ago, 2 if the nonce is valid and generated between 12-24 hours ago.
     */
    public function checkAjaxReferer($name = false, $die = true) {
        return check_ajax_referer($this->action, $name, $die);
    }

}
