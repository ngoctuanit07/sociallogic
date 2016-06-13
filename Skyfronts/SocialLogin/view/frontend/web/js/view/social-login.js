/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true*/
/*global alert*/
define(
    [
        'jquery',
        'uiComponent',
        'Magento_Ui/js/form/form',
        'Magento_Customer/js/action/login',
        'Magento_Customer/js/model/customer',
        'mage/validation',
        'Magento_Checkout/js/model/authentication-messages',
        'Magento_Checkout/js/model/full-screen-loader'
    ],
    function($, Component, loginAction, customer, validation, messageContainer, fullScreenLoader) {
        'use strict';
        var checkoutConfig = window.checkoutConfig;
        var facebook = window.checkoutConfig.facebook;
        var google =  window.checkoutConfig.google;
        var twitter =  window.checkoutConfig.twitter;
        var facebook_enable = window.checkoutConfig.facebook_config;
        var google_enable =  window.checkoutConfig.google_config;
        var twitter_enable =  window.checkoutConfig.twitter_config;
        var facebook_auth_link = window.checkoutConfig.facebook_link;
        var google_auth_link = window.checkoutConfig.google_link;
        var twitter_auth_link = window.checkoutConfig.twitter_link;
        return Component.extend({
            defaults: {
                template: 'Skyfronts_SocialLogin/social-login'
            },
            facebook_link: facebook,
            google_link: google,
            twitter_link: twitter,
            facebook_enable: facebook_enable,
            google_enable: google_enable,
            twitter_enable: twitter_enable,
            facebook_auth_link:facebook_auth_link,
            google_auth_link:google_auth_link,
            twitter_auth_link:twitter_auth_link
        });
      /*  var links = window.checkoutConfig.custom;
        return Component.extend({
            defaults: {
                template: 'Skyfronts_SocialLogin/social-login'
            },
            link: links
        });*/
    }
);