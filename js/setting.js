

/// <reference path="../../assets/js/jquery-1.7.1.min.js" />
/// <reference path="../../assets/js/bajl.js" />
/// <reference path="../../assets/js/AMIX.shared.js" />
(function ($, window, AMIX) {
    "use strict";

    if (!AMIX.settings) AMIX.settings = {};

    /* ----- Settings: MegaMenu ----- */
    AMIX.settings.MegaMenu = {
          path: ''
        , pathMatchOverrides: [
            { stayHrefPattern: /\/jp\/ja\/case\/\?menu=voice/, locationPattern: /\/jp\/ja\/case\/((index.php)?\?menu=voice|voice\/)/ }
            , { stayHrefPattern: /\/jp\/ja\/case\/\?menu=introduction/, locationPattern: /\/jp\/ja\/case\/((index.php)?\?menu=introduction|introduction\/)/ }
            , { stayHrefPattern: /\/jp\/ja\/case\/(index.php)?\??$/, locationPattern: /\/jp\/ja\/case\/(index.php)?\??$/ }
            , { stayHrefPattern: /\/jp\/ja\/news\/\?menu=release/, locationPattern: /\/jp\/ja\/news\/((index.php)?\?menu=release|release\/)/ }
            , { stayHrefPattern: /\/jp\/ja\/news\/\?menu=event/, locationPattern: /\/jp\/ja\/news\/(index.php)?\?menu=event/ }
            , { stayHrefPattern: /\/jp\/ja\/news\/(index.php)?\??$/, locationPattern: /\/jp\/ja\/news\/(index.php)?\??$/ }
            , { stayHrefPattern: /\/jp\/ja\/corporate\/(index.html)?$/, locationPattern: /\/jp\/ja\/corporate\/(index.html)?$/ }
            , { stayHrefPattern: /\/jp\/ja\/corporate\/ir\/(index.html)?$/, locationPattern: /\/jp\/ja\/corporate\/ir\/(index.html)?$/ }
            , { stayHrefPattern: /\/jp\/ja\/corporate\/profile\/(index.html)?$/, locationPattern: /\/jp\/ja\/corporate\/profile\/(index.html)?$/ }
            , { stayHrefPattern: /\/jp\/ja\/corporate\/csr\/(index.html)?$/, locationPattern: /\/jp\/ja\/corporate\/csr\/(index.html)?$/ }
        ]
    };

    /* ----- Settings: ShareTools ----- */
    AMIX.settings.ShareTools = {
        path: ''
    };

    /* ----- Settings: MobileMenu ----- */
    AMIX.settings.MobileMenu = {
        path: ''
    };

    /* ----- Settings: SlideImpression.Home ----- */
    AMIX.settings.SlideImpression_Home = {
        path: 'js/data.xml'
    };

    /* ----- Settings: FixedHeader.Home ----- */
    AMIX.settings.FixedHeader_Home = {
//        path: '#bass-header-area'
        path: ''

    };

    /* ----- Settings: Search ----- */
    $(function () {
        // スマートフォンの時のみ検索結果画面のURLを変更する
        if (AMIX.Shared.Environment.UserAgent.isSmartphone) {
           // $('.site-search form').attr('action', '');
        }
    });

})(BAJL.jQuery, window, AMIX);