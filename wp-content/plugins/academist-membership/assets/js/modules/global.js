// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if (typeof eltdfSocialLoginVars !== 'undefined') {
    var facebookAppId = eltdfSocialLoginVars.social.facebookAppId;
}
if (facebookAppId) {
    window.fbAsyncInit = function () {
        FB.init({
            appId: facebookAppId, //265124653818954 - test app ID
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof eltdf !== 'undefined' ) {
        eltdf.modules.socialLogin = socialLogin;
    }

    socialLogin.eltdfUserLogin = eltdfUserLogin;
    socialLogin.eltdfUserRegister = eltdfUserRegister;
    socialLogin.eltdfUserLostPassword = eltdfUserLostPassword;
    socialLogin.eltdfInitWidgetModal = eltdfInitWidgetModal;
    socialLogin.eltdfInitFacebookLogin = eltdfInitFacebookLogin;
    socialLogin.eltdfInitGooglePlusLogin = eltdfInitGooglePlusLogin;
    socialLogin.eltdfRenderAjaxResponseMessage = eltdfRenderAjaxResponseMessage;

    $(document).ready(eltdfOnDocumentReady);
    $(window).load(eltdfOnWindowLoad);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitWidgetModal();
        eltdfUserLogin();
        eltdfUserRegister();
        eltdfUserLostPassword();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitFacebookLogin();
        eltdfInitGooglePlusLogin();
        eltdfMembershipFullScreen();
    }

    /**
     * Initialize register widget modal
     */
    function eltdfInitWidgetModal() {
        var modalOpeners = $('.eltdf-modal-opener'),
            modalHolders = $('.eltdf-modal-holder');

        if (modalOpeners.length && modalHolders.length) {

            //Init opening login modal
            modalOpeners.click(function (e) {
                e.preventDefault();
                var thisModalOpener = $(this);
                var type = thisModalOpener.data("modal");
                modalHolders.fadeOut(300);
                modalHolders.removeClass('opened');
                modalHolders.each(function(){
                    var thisModalHolder = $(this);
                    if(thisModalHolder.data('modal') !== 'undefined' && thisModalHolder.data('modal') === type) {
                        thisModalHolder.fadeIn(300);
                        thisModalHolder.addClass('opened');
                    }
                });
            });

            modalHolders.each(function() {
                var thisModalHolder = $(this);

                //Init closing login modal
                thisModalHolder.click(function (e) {
                    if (thisModalHolder.hasClass('opened')) {
                        thisModalHolder.fadeOut(300);
                        thisModalHolder.removeClass('opened');
                    }
                });

                // on esc too
                $(window).on('keyup', function (e) {
                    if (thisModalHolder.hasClass('opened') && e.keyCode === 27) {
                        thisModalHolder.fadeOut(300);
                        thisModalHolder.removeClass('opened');
                    }
                });

                var modalContent = thisModalHolder.find('.eltdf-modal-content');
                modalContent.click(function (e) {
                    e.stopPropagation();
                });
            });
        }
    }

    /**
     * Login user via Ajax
     */
    function eltdfUserLogin() {
        $('.eltdf-login-form').on('submit', function (e) {
            e.preventDefault();
            
            var ajaxData = {
                action: 'academist_membership_login_user',
                security: $(this).find('#eltdf-login-security').val(),
                login_data: $(this).serialize()
            };
            
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
            
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function eltdfUserRegister() {
        $('.eltdf-register-form').on('submit', function (e) {
            e.preventDefault();
            
            var ajaxData = {
                action: 'academist_membership_register_user',
                security: $(this).find('#eltdf-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function eltdfUserLostPassword() {
        var lostPassForm = $('.eltdf-reset-pass-form');
        
        lostPassForm.on('submit', function (e) {
            e.preventDefault();
            
            var data = {
                action: 'academist_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            
            $.ajax({
                type: 'POST',
                data: data,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function eltdfRenderAjaxResponseMessage(response) {
        var responseHolder = $('.eltdf-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.eltdf-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'eltdf-membership-message-succes';
        } else {
            messageClass = 'eltdf-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Facebook Login
     */
    function eltdfInitFacebookLogin() {
        var loginForm = $('.eltdf-facebook-login-holder');
        loginForm.on('submit', function (e) {
            e.preventDefault();
            
            window.FB.login(function (response) {
                eltdfFacebookCheckStatus(response);
            }, {scope: 'email, public_profile'});
        });
    }

    /**
     * Check if user is logged into Facebook and App
     *
     * @param response
     */
    function eltdfFacebookCheckStatus(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            eltdfGetFacebookUserData();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    /**
     * Get user data from Facebook and login user
     */
    function eltdfGetFacebookUserData() {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', {'fields': 'id, name, email, link, picture'}, function (response) {
            var nonce = $('.eltdf-facebook-login-holder [name^=eltdf_nonce_facebook_login]').val();
            response.nonce = nonce;
            response.image = response.picture.data.url;
            var data = {
                action: 'academist_membership_check_facebook_user',
                response: response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Google Login
     */
    function eltdfInitGooglePlusLogin() {
        if (typeof eltdfSocialLoginVars !== 'undefined') {
            var clientId = eltdfSocialLoginVars.social.googleClientId;
        }
        
        if (clientId) {
            gapi.load('auth2', function () {
                window.auth2 = gapi.auth2.init({
                    client_id: clientId
                });
                eltdfInitGooglePlusLoginButton();
            });
        } else {
            var loginForm = $('.eltdf-google-login-holder');
            loginForm.on('submit', function (e) {
                e.preventDefault();
            });
        }
    }

    /**
     * Initialize login button for Google Login
     */
    function eltdfInitGooglePlusLoginButton() {
        var loginForm = $('.eltdf-google-login-holder');
        
        loginForm.on('submit', function (e) {
            e.preventDefault();
            
            window.auth2.signIn();
            eltdfSignInCallback();
        });
    }

    /**
     * Get user data from Google and login user
     */
    function eltdfSignInCallback() {
        var signedIn = window.auth2.isSignedIn.get();
        
        if (signedIn) {
            var currentUser = window.auth2.currentUser.get(),
                profile = currentUser.getBasicProfile(),
                nonce = $('.eltdf-google-login-holder [name^=eltdf_nonce_google_login]').val(),
                userData = {
                    id: profile.getId(),
                    name: profile.getName(),
                    email: profile.getEmail(),
                    image: profile.getImageUrl(),
                    link: 'https://plus.google.com/' + profile.getId(),
                    nonce: nonce
                },
                data = {
                    action: 'academist_membership_check_google_user',
                    response: userData
                };
            $.ajax({
                type: 'POST',
                data: data,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    eltdfRenderAjaxResponseMessage(response);
                    if (response.status === 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        }
    }

    function eltdfMembershipFullScreen() {
        var membership = $('.eltdf-membership-main-wrapper');
        var profileContent = $('.page-template-user-dashboard .eltdf-content');
        var footer = $('.eltdf-page-footer');
        var reduceHeight = 0;

        if(!eltdf.body.hasClass('eltdf-header-transparent') && eltdf.windowWidth > 1024) {
            reduceHeight = reduceHeight + eltdfGlobalVars.vars.eltdfMenuAreaHeight + eltdfGlobalVars.vars.eltdfLogoAreaHeight;
        }
        if(footer.length > 0) {
            reduceHeight += footer.outerHeight();
        }

        if(eltdf.windowWidth > 1024) {
            var height = eltdf.windowHeight - reduceHeight;
            profileContent.css({'min-height': height  + 'px'});
        }
    }

})(jQuery);