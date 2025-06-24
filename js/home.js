
(function (window, $, SlideImpression) {
    "use strict";

    /* ----- HeadlineLinks class */
    function HeadlineLinks (settings) {
        this.settings = $.extend(HeadlineLinks.defaultSettings, settings || {});
        this.toggleButton = null;
        this.isShown = true;
    }
    HeadlineLinks.defaultSettings = {
         maxCount: 1
    };
    HeadlineLinks.prototype.setup = function () {
        this.toggleButton = $('<li class="open-button">').append(
                                $('<a href="#"></a>').click($.proxy(function (e) {
                                    e.preventDefault();
                                    this.toggle();
                                }, this)
                            ));
        $('#bass-news-headlines-area .news-list').append(this.toggleButton).addClass('with-open-button');
        this.hide(true);
    }

    HeadlineLinks.prototype.toggle = function () {
        if (this.isShown) {
            this.hide();
        } else {
            this.show();
        }
    }

    HeadlineLinks.prototype.show = function () {
        if (this.isShown) return;
        $('#bass-news-headlines-area .news-list li:not(.open-button)')
            .slice(this.settings.maxCount)
            .slideDown()
            .fadeIn();
        this.isShown = true;
        this.toggleButton.find('img').attr('alt', 'Close').attr('src', '/assets/img/common/icon_home-news-arrow_01.png');
    }
    HeadlineLinks.prototype.hide = function (immediate) {
        if (!this.isShown) return;
        if (immediate) {
            $('#bass-news-headlines-area .news-list li:not(.open-button)')
                .slice(this.settings.maxCount)
                .hide();
        } else {
            $('#bass-news-headlines-area .news-list li:not(.open-button)')
                .slice(this.settings.maxCount)
                .slideUp()
                .fadeOut();
        }
        this.toggleButton.find('img').attr('alt', 'Open').attr('src', '/assets/img/common/icon_home-news-arrow_02.png');
        this.isShown = false;
    }

    /* ----- SlideImpression.Home class ----- */
    SlideImpression.Home = function (targetArea, xmlDataUrl) {
        this.initialize(targetArea, xmlDataUrl);
        AMIX.Shared.Screen.registerHandler($.proxy(function (type) {
            if (this.isReady) {
                this.thumbnailAndNavigationNodes.find('.bass-pagetitlenavigation-A01')
                    .css('display', (type == AMIX.Shared.Screen.Types.FULL) ? '' : 'none');
            }
        }, this));
    }
    SlideImpression.Home.prototype = new SlideImpression();
    SlideImpression.Home.prototype.onBeforeLoadEntries = function () {
        this.thumbnailAndNavigationNodes = $(
            '<div class="slidenav">' +
            '<div class="bass-pagetitlenavigation-frame">' +
            '<ul class="bass-pagetitlenavigation-A01 js-inserted">' +
            '<li class="prev"><a href="#"><span>Prev</span></a></li>' +
            '<li class="next"><a href="#"><span>Next</span></a></li>' +
            '</ul>' +
            '</div>' +
            '<div class="bass-thumbnails js-inserted">' +
            '<div class="nav"><nav>' +
            '<ul class="bass-thumbnail-list-A01">' +
            '</ul>' +
			//
/*            '<ul class="bass-control-list-A01 js-inserted">' +
            '<li class="stop"><a href="#"><span>Stop</span></a></li>' +
           '<li class="start stay"><a href="#"><span>Start</span></a></li>' +
            '</ul>' +
            '<div class="loading"><img src="img/icon_loading_01.gif" alt="Loading"></div>' +
*/			
			//
            '</nav></div>' +

            '<!-- /bass-thumbnails --></div>' +
            '</div>'
        );

        // show loading only (hide navs)
        this.thumbnailAndNavigationNodes
                .find('.bass-pagetitlenavigation-A01')
                    .hide()
                    .end()
                .find('.bass-thumbnails nav ul')
                    .hide()
                    .end()
                .find('.loading')
                    .hide();

        var self = this;
        this.thumbnailAndNavigationNodes
            .find('.loading')
                .fadeIn('slow')
                .end()
            .find('.bass-pagetitlenavigation-A01')
                .on('click', '.prev', function (e) { e.preventDefault(); self.prev(); })
                .on('click', '.next', function (e) { e.preventDefault(); self.next(); })
                .end()
            .on('click', '.bass-thumbnails ul.bass-thumbnail-list-A01 li a', function (e) {
                e.preventDefault();
                var index = $(this).data('AMIX-slideimpression-index');
                self.select(index, index > self.currentIndex);
            })
            .appendTo($('#bass-home-feature-area'));
    }
    SlideImpression.Home.prototype.prepareView = function () {
        var ulNode = this.thumbnailAndNavigationNodes.find('.bass-thumbnails ul.bass-thumbnail-list-A01');
        $.each(this.entries, function (i, entry) {
            var titleText = $('<div />').html(entry.title).text();
            return $('<li><a href="#"></a></li>')
                        .toggleClass('stay', i == 0)
                        .find('a')
                            .data('AMIX-slideimpression-index', i)
                            .text(titleText)
                            .end()
                        .appendTo(ulNode);
        });

        var frameViewport = $('<div class="bass-slide-viewport" />');
        this.targetAreaNode.find('#featureA01')
            .wrap(frameViewport)
            .find('h1, p, ul').css('position', 'relative');

        // hide loading and show navs
        this.thumbnailAndNavigationNodes
            .find('.loading')
                .fadeOut('fast')
            .promise()
            .then($.proxy(function () {
                var self = this;
                var prevNextBtnShow = function() {
                    var d = $.Deferred();
                    if (AMIX.Shared.Screen.type == AMIX.Shared.Screen.Types.FULL) {
                        self.thumbnailAndNavigationNodes.find('.bass-pagetitlenavigation-A01').fadeIn('slow')
                            .promise()
                            .then(function() {
                                d.resolve();
                            });
                    } else {
                        d.resolve();
                    }
                    return d.promise();
                };

                var thumbnailsMenuShow = function() {
                    var d = $.Deferred();
                    self.thumbnailAndNavigationNodes
                        .find('.bass-thumbnails nav ul.bass-thumbnail-list-A01')
                            .show()
                        .find('li')
                            .each(function (i, e) {
                                var $e = $(e);
                                var offset = i * 46;
                                $e
                                    .css('position', 'relative')
                                    .css('left', -offset + 'px')
                                    .css('opacity', 0);
                                $e.animate({ left: '+='+offset+'px', opacity: 1 }, 500, 'easeOutQuad')
                                    .promise()
                                    .then(function() {
                                        d.resolve();
                                });
                            });
                    return d.promise();
                };

                var controlIconShow = function() {
                    var d = $.Deferred();
                    self.thumbnailAndNavigationNodes
                        .find('.bass-thumbnails nav ul.bass-control-list-A01').fadeIn("slow")
                        .promise()
                        .then(function() {
                            d.resolve();
                        });
                    return d.promise();
                };

                var firstSlide = function() {
                    var d = $.Deferred();
                    var $frame = $(".bass-pagetitle-image");

                    if ($frame.css("visibility") == "visible") {
                        return d.resolve().promise();
                    }

                    var $h1 = $frame.find("h1").css({opacity: 0, left: "20%"});
                    var $p = $frame.find("p").css({opacity: 0, left: "20%"});
                    var $read = $frame.find(".read-more").css({opacity: 0, left: "20%"});
                    $frame.css({opacity: 0, visibility: "visible",left: "20%"});                    

                    $frame.animate({opacity: 1, left: 0},{"duration": 650});
                    $h1.animate({opacity: 1, left: 0},{"duration": 650});
                    $p.animate({opacity: 1, left: 0},{"duration": 650});
                    $read.animate({opacity: 1, left: 0},{"duration": 650})
                        .promise()
                        .then(function() {
                            d.resolve();
                        });
                    return d.promise();
                };

                var sleep = function(deray) {
                    var d = $.Deferred();
                    setTimeout(function(){
                        d.resolve();
                    }, deray);
                    return d.promise();
                };

                sleep(100)
                    .pipe(function() {
                        self.thumbnailAndNavigationNodes.find('.loading').hide();
                    })
                    .pipe(thumbnailsMenuShow)
                    .pipe(function() {
                        return sleep(100);
                    })
                    .pipe(firstSlide)
                    .pipe(function() {
                        return sleep(100);
                    })
                    .pipe(function() {
                        return $.when(
                            prevNextBtnShow(),
                            controlIconShow()
                        );
                    })
                    .pipe(function() {
                        self.autoSlide();
                        if (AMIX.Shared.Screen.isSmartphone) {
                            $("#bass-home-feature-area").find(".stop").click();
                        }
                    });

            }, this));
    }

    SlideImpression.Home.prototype.onEntrySelected = function (index, entry, isForward) {
        this.thumbnailAndNavigationNodes
            .find('.bass-thumbnails ul.bass-thumbnail-list-A01')
                .find('li')
                    .removeClass('stay')
                    .eq(index)
                        .addClass('stay')
                        .end()
                    .end()
                .end();

        var isIE6Or7 = (BAJL.ua.isIE && BAJL.ua.version < 8);
        var frameViewport = this.targetAreaNode.find('.bass-slide-viewport');
        var pageTitleImage = frameViewport.find('.bass-pagetitle-image');

        var self = this;
        frameViewport
            .css('background-image', pageTitleImage.css('background-image'))
        ;

        pageTitleImage
            .animate({ left: (isForward ? '+=' : '-=') + self.transitionOptions.startPosition }, 0)
            .css('opacity', 0)
            .attr('class', 'bass-pagetitle-image')
            .addClass(entry.styleClasses)
            .find('h1')
                .css('left', (isForward ? '' : '-') + '150px')
                .css('opacity', isIE6Or7 ? 1 : 0)
                .end()
            .find('p, ul')
                .css('left', (isForward ? '' : '-') + '250px')
                .css('opacity', isIE6Or7 ? 1 : 0)
                .end()
            .find('h1 span')
                .html(entry.title)
                .end()
            .find('p span')
                .html(entry.description)
                .end()
            .find('.read-more li a')
                .attr('href', entry.linkUrl)
                .find('span.all')
                    .html(entry.linkText)
                    .end()
                .end()
            .promise()
            .then(function() {
                var animate1 = pageTitleImage
                                    .css('background-image', 'url(' + entry.imageUrl + ')')
                                    .find('.bass-frame-content')
                                        .css('background-image', 'url(' + entry.imageUrl + ')')
                                        .end()

                                    .animate({ left: (isForward ? '-=' : '+=') + self.transitionOptions.startPosition, opacity: 1 }, self.transitionOptions.duration, self.transitionOptions.easing)
                                    .promise();

                var animate2 = pageTitleImage
                                    .find('h1, p, ul')
                                        .animate({ left: '0px', opacity: 1 }, self.transitionOptions.duration, self.transitionOptions.easing)
                                        .promise();

                $.when(animate1, animate2).then(function () {
                    self.isInTransition = false;
                });
            })
        ;
    }
    /* ----- /SlideImpression.Home class ----- */

    /* ----- SlidePickups class ----- */
    function SlidePickups (settings) {
        this.currentIndex = 0;
        this.node = null;
        this.navIndicesNode = null;
        this.entries = null;
        this.settings = $.extend(SlidePickups.defaultSettings, settings);
    }
    SlidePickups.defaultSettings = {
        exprs: {
            nav      : { prev: '.bass-slide-nav-prev', next: '.bass-slide-nav-next' },
            container: '.bass-indexlist-B01',
            item     : '.article',
            title    : 'h1'
        },
        adjustSize: (BAJL.ua.isIE && BAJL.ua.version < 8) ? 0 : -3,
        transition: {
            duration: 650,
            easing  : 'swing'
        },
        classNames: {
            slideEnabled  : 'bass-slide-enabled',
            itemShadowNode: 'bass-slide-item-shadow',
            itemCurrent   : 'bass-slide-item-current',
            itemMoving    : 'bass-slide-item-moving',
            navStay       : 'bass-slide-nav-stay'
        }
    };

    SlidePickups.prototype.setup = function (node) { 
        var settings = this.settings;

        this.node = node;
        this.entries = node.find(settings.exprs.item);

        // show only first
        this.entries.first().addClass(settings.classNames.itemCurrent);

        if (!this.hasEntries()) return;

        this.node.addClass(settings.classNames.slideEnabled);

        this.node
            .find('.bass-pager-A01')
                .prepend(
                    $('<div class="equal-nav">' +
                      '<nav>' +
                      '<div class="bass-pager-title"></div>' +
                      '<ul class="bass-slide-nav-indices">' +
                      '</ul>' +
                      '</nav>' +
                      '<!-- /equal-nav --></div>')
                        .find('.bass-pager-title')
                            .text(this.node.find(settings.exprs.title).text())
                            .end()
                )
                .after(
                    $('<ul class="bass-topicsnavigation-A01 js-inserted">' +
                      '<li class="prev"><a href="#"><span>Prev</span></a></li>' +
                      '<li class="next"><a href="#"><span>Next</span></a></li>' +
                      '</ul>')
                      .find('.prev')
                        .click($.proxy(function (e) { e.preventDefault(); this.prev(); }, this))
                        .end()
                      .find('.next')
                        .click($.proxy(function (e) { e.preventDefault(); this.next(); }, this))
                        .end()
                )
                .end()
            .find('.bass-indexlist-B01')
                .wrap('<div class="bass-slide-viewport" />')
                .end()
        ;
        
        this.navIndicesNode = this.node.find('.bass-slide-nav-indices');

        this.updatePager();

        // attach events
        node.find(settings.exprs.nav.prev).click($.proxy(function (e) { e.preventDefault(); this.prev(); }, this));
        node.find(settings.exprs.nav.next).click($.proxy(function (e) { e.preventDefault(); this.next(); }, this));
        
        // nav
        var isIE6Or7 = (BAJL.ua.isIE && BAJL.ua.version < 8);
        if (isIE6Or7) { this.node.find('.bass-topicsnavigation-A01').hide(); return; }

        this.node.find('.bass-topicsnavigation-A01').toggle((AMIX.Shared.Screen.type == AMIX.Shared.Screen.Types.FULL));
        AMIX.Shared.Screen.registerHandler($.proxy(function (type) {
            this.node.find('.bass-topicsnavigation-A01')
                .toggle((type == AMIX.Shared.Screen.Types.FULL));
        }, this));
    }

    /**
     * update pager
     * @return void
     */
    SlidePickups.prototype.updatePager = function () {
        this.navIndicesNode.empty();
        for (var i = 0, n = this.entries.length; i < n; i++) {
            var node = null;
            if (i == this.currentIndex) {
                node = $('<em />');
            } else {
                node = $('<a class="bass-slide-nav-indices-index" href="#"></a>')
                    .click($.proxy(function (e) {
                        e.preventDefault();
                        var index = parseInt($(e.currentTarget).text(), 0)-1;
                        this.select(index, this.currentIndex < index);
                    }, this));
            }

            // style & text
            node.text(i+1)
                .addClass(i == 0 ? 'pseudo-first-child' : (i == n-1) ? 'pseudo-last-child' : '')

            this.navIndicesNode.append($('<li />').append(node));
        }
    }


    /* ----- View Control Methods ----- */
    /**
     * select a entry by index.
     * @param {Integer}    index        a index of entry
     * @param {Boolean}    isForward    slide direction is forward.
     * @return void
     */
    SlidePickups.prototype.select = function (index, isForward) {
        if (this.isInTransition || this.currentIndex == index) return;

        this.isInTransition = true;
        this.previousIndex = this.currentIndex;
        this.currentIndex = index;

        this.onEntrySelected(index, isForward);
        this.updatePager();
    }

    /**
     * call when a entry is selected.
     * @param {Integer}                  index        a index of entry
     * @param {Boolean}                  isForward    slide direction is forward.
     * @return void
     */
    SlidePickups.prototype.onEntrySelected = function (index, isForward) {
        var settings = this.settings;
        var node = this.node;
        var currentItem = node.find(settings.exprs.item + '.' + settings.classNames.itemCurrent);
        var nextItem = node.find(settings.exprs.item).eq(index);

        // stay
        this.navIndicesNode.find('.bass-slide-nav-indices-index')
            .removeClass(settings.classNames.navStay)
            .eq(index)
                .addClass(settings.classNames.navStay)
        ;

        // add a placeholder element
        var shadowNode = currentItem
            .clone()
                .empty()
                .addClass(settings.classNames.itemShadowNode)
                .css('height', currentItem.height()+settings.adjustSize + 'px')
                .animate({ height: nextItem.height()+settings.adjustSize + 'px' }, settings.transition.duration, settings.transition.easing)
                .css('width', '100%')
                .appendTo(node.find(settings.exprs.container));

        // calculate current width
        var currentWidth = currentItem.width();

        // set moving-state
        currentItem
            .removeClass(settings.classNames.itemCurrent)
            .addClass(settings.classNames.itemMoving);

        node.find(settings.exprs.item)
            .eq(this.previousIndex)
                .css('left', '0%')
                .css('width', currentWidth + 'px')
                .animate((isForward ? { left: '-100%' } : { left: '100%' }), settings.transition.duration, settings.transition.easing)
                .end()
            .eq(index)
                .addClass(settings.classNames.itemMoving)
                .css('left', (isForward ? '100%' : '-100%'))
                .css('width', currentWidth + 'px')
                .animate({ left: '0%' }, settings.transition.duration, settings.transition.easing)
                .promise()
                .then($.proxy(function () {
                    // unset moving-state
                    node.find(settings.exprs.item)
                        .removeClass(settings.classNames.itemMoving + ' ' + settings.classNames.itemCurrent)
                        .css('width', '')
                        .eq(index)
                            .addClass(settings.classNames.itemCurrent)
                            .end()
                        ;
                    shadowNode.remove();
                    this.isInTransition = false;

                }, this))
        ;
    }
    SlidePickups.prototype.next = function () {
        this.select(this.isLast() ? 0 : this.currentIndex + 1, true);
    }
    SlidePickups.prototype.prev = function () {
        this.select(this.isFirst() ? this.entries.length - 1 : this.currentIndex - 1, false);
    }
    SlidePickups.prototype.isFirst = function () {
        return this.currentIndex == 0;
    }
    SlidePickups.prototype.isLast = function () {
        return this.currentIndex == this.entries.length-1;
    }
    SlidePickups.prototype.hasEntries = function () {
        return this.entries && this.entries.length > 1;
    }
    /* ----- /View Control Methods ----- */
    /* ----- /SlidePickups class ----- */

    // Setup
    $(function () {
        if (AMIX.settings.SlideImpression_Home && AMIX.settings.SlideImpression_Home.path) {
            var slideImpression = new SlideImpression.Home("#bass-home-feature-area", AMIX.settings.SlideImpression_Home.path);
            slideImpression.setup();
        }

        // setup headline link
        new HeadlineLinks().setup();

        // setup slidepickup
        $('.pickup-content-area .bass-home-topics-B01').each(function (i, e) { new SlidePickups().setup($(e)); });
    });

    //first slide hidden
    $("head").append('<style type="text/css">.bass-pagetitle-image {visibility:hidden;}</style>');

    preload();
    function preload() {
        var imgList = [
            "img/icon_menu_01_hover.png",
            "img/icon_menu_active_01_hover.png"
        ];

        $.each(imgList, function(i) {
            $("<img>").attr("src", imgList[i]);
        });
    }
})(window, BAJL.jQuery, AMIX.SlideImpression);