(function ($) {
    'use strict';

    var albumsSlider = {};
    edge.modules.albumsSlider = albumsSlider;

    albumsSlider.edgeOnDocumentReady = edgeOnDocumentReady;
    albumsSlider.edgeOnWindowLoad = edgeOnWindowLoad;
    albumsSlider.edgeOnWindowResize = edgeOnWindowResize;
    albumsSlider.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeAlbumsSliderMouseWheelScroll();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    function edgeAlbumsSliderMouseWheelScroll() {

        if ($('.edge-albums-player-slider-holder .edge-alb-with-player .edge-owl-slider').length) {
            $('.edge-albums-player-slider-holder .edge-alb-with-player .edge-owl-slider').each(function () {
                var $this = $(this);

                // check for mouseWheel option and enables functionality
                var mouseWheelEnabled = $('.edge-albums-player-slider-holder .edge-alb-with-player').data('slider-mousewheel');

                if (mouseWheelEnabled !== 'undefined' && mouseWheelEnabled === 'yes') {

                    // allow one mousewheel each 0.5 second
                    var timestamp_mousewheel = 0; //Define if not in a function

                    $this.on("mousewheel", ".owl-stage", function (e) {
                        var d = new Date();

                        /*on mousewheel event compare two times to allow event every 0.5 second*/
                        if ((d.getTime() - timestamp_mousewheel) > 500) {

                            /*acquire new time for comparison*/
                            timestamp_mousewheel = d.getTime();

                            if (e.deltaY > 0) {
                                $this.trigger('next.owl');
                            } else {
                                $this.trigger('prev.owl');
                            }
                            e.preventDefault();
                        }
                    });
                }
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var eventsList = {};
    edge.modules.eventsList = eventsList;

    eventsList.edgeOnDocumentReady = edgeOnDocumentReady;
    eventsList.edgeOnWindowLoad = edgeOnWindowLoad;
    eventsList.edgeOnWindowResize = edgeOnWindowResize;
    eventsList.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeInitAudioPlayer().init();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
        edgeAlbumPlayButton();
        edgeInitAlbumsLoadMore();
        edgeInitAlbumReviews();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    function edgeInitAlbumReviews(){

        var reviews = $('.edge-single-album-reviews');
        if(reviews.length){
            reviews.each(function(){
                var swiper = $(this);
                var activeSlide = swiper.find('.swiper-slide-active');
                var allSlides = swiper.find('.edge-swiper-all-slides');
                var swiperWrapper = swiper.find('.swiper-wrapper');

                var swiperSlider = new Swiper(swiper, {
                    loop: true,
                    parallax: true,
                    slidesPerView: 1,
                    visibilityFullFit: true,
                    autoResize: false,
                    speed: 500,
                    effect: 'slide',
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'fraction',
                    }
                });
                

            });
        }
    }

    function edgeInitAudioPlayer() {
        var players = $('.edge-audio-player-wrapper');

        var albumPlaylist = function(player) {

            var ajaxData = {
                action: 'noizzy_music_album_playlist',
                album_id : player.find('.edge-audio-player-holder').data('album-id')
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgeGlobalVars.vars.edgeAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if(response.status == 'success'){
                        albumPlayer(response.sdata, player);

                        setTimeout(function(){
                            player.addClass('edge-apw-loaded');
                        },400);

                        player.appear(function() {
                            player.addClass('edge-apw-appeared');
                        },{accX: 0, accY: 0 });
                    }

                }
            });
        };

        var flagTrack = 0;

        var albumPlayer = function(data, player) {
            var jPlayerSelector = '#'+player.find('.jp-jplayer').attr('id');
            var jCssSelectorAncestorSelector = '#'+player.find('.edge-audio-player-holder').attr('id');

            var playlist = new jPlayerPlaylist({
                jPlayer: jPlayerSelector,
                cssSelectorAncestor: jCssSelectorAncestorSelector
            }, data , {
                playlistOptions: {
                    autoPlay: false
                },
                supplied: "mp3",
                wmode: "window",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true,
                ready: function() {
                    setTrackTitle(playlist, player);
                    playOnClickOnSingle(playlist);
                    playlist.setPlaylist(data);
                },
                play: function() {
                    setTrackTitle(playlist, player);
                    setActiveTrackOnSigle(playlist)
                },
                loadedmetadata: function() {
                    if (flagTrack < 2) {
                        setTracksImages(player, data);
                    }
                }
            });

        };

        var setTracksImages = function(player, data) {
            flagTrack++;
            var tracksList = player.find('.edge-audio-player-tracks-images-holder');

            for (var i = 0; i < data.length; i++) {
                tracksList.find('li:nth-child(' + (i+1) + ') .jp-playlist-item').append('<img src="' + data[i].poster + '"/><span></span>');
                $('.tracks-list li:nth-child(' + (i+1) + ')').addClass('swiper-slide');
            }

            /*var swiper = new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 0,
                mousewheel: false,
                //loop: true,
                //loopAdditionalSlides: 5,
                slideClass: 'swiper-slide'
            });*/

            setTimeout(function(){
                var tracksListHeight = tracksList.height();
                player.css('margin-top', tracksListHeight );
                tracksList.css('top', -tracksListHeight);
            }, 300);
        }

        var setTrackTitle = function(playlist, player) {
            var titleHolder = player.find('.edge-audio-player-title');
            var artistHolder = player.find('.edge-audio-player-artist');

            titleHolder.html(playlist.original[playlist.current].title);
            artistHolder.html(playlist.original[playlist.current].artist_name);
        };
        var setActiveTrackOnSigle = function(playlist) {
            var activeSong = playlist.original[playlist.current].unique_id;
            var tracksSingleHolder = $('.edge-album-tracks-holder');
            if(tracksSingleHolder.length) {
                tracksSingleHolder.find('.edge-track-holder').removeClass('edge-active-track');
                tracksSingleHolder.find('.'+activeSong).addClass('edge-active-track');
            }
        };
        var playOnClickOnSingle = function(playlist) {
            var tracksSingleHolder = $('.edge-album-tracks-holder');
            if(tracksSingleHolder.length) {
                tracksSingleHolder.find('.edge-track-title').on('click', function(){
                    var track = $(this);
                    var trackIndex = track.data('track-index');
                    playlist.play(trackIndex);
                });
            }

        };
        return {
            init: function() {
                if(players.length) {
                    players.each(function() {
                        albumPlaylist($(this));
                    });
                }
            }
        };
    }

    function edgeAlbumPlayButton() {
        var albums = $('.edge-album-track-list');
        if (albums.length) {
            albums.each(function(){
                var album = $(this);
                var albumID = $(this).attr('id');
                var tracks = album.find('.edge-album-track');
                var audioTracks = tracks.find('audio');

                tracks.each(function(){
                    var track = $(this);
                    var playButton = track.find('.edge-at-play-button');

                    var audioTrack = playButton.find('audio').get(0);
                    playButton.on('click',function(){
                        if(track.hasClass('edge-track-in-progress')){
                            audioTrack.pause();
                            track.addClass('edge-track-paused').removeClass('edge-track-in-progress');
                        }else if(track.hasClass('edge-track-paused')) {
                            audioTrack.play();
                            track.addClass('edge-track-playing edge-track-in-progress').removeClass('edge-track-paused')
                        }else{
                            audioTracks.each(function(){
                                this.pause();
                                this.currentTime = 0;
                            });
                            tracks.removeClass('edge-track-playing edge-track-in-progress edge-track-paused');
                            audioTrack.play();
                            track.addClass('edge-track-playing edge-track-in-progress')
                        }
                    });

                    track.find('audio').on("ended", function(){
                        track.removeClass('edge-track-playing edge-track-in-progress');
                    });
                });
            });
        }
    }

    /**
     * Initializes albums load more function
     */
    function edgeInitAlbumsLoadMore(){
        var albumsList = $('.edge-albums-list-holder-outer.edge-albums-load-more');

        if(albumsList.length){
            albumsList.each(function(){

                var thisAlbumList = $(this);
                var thisAlbumListInner = thisAlbumList.find('.edge-albums-list-holder');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisAlbumList.find('.edge-albums-list-load-more a');

                if (typeof thisAlbumList.data('max-num-pages') !== 'undefined' && thisAlbumList.data('max-num-pages') !== false) {
                    maxNumPages = thisAlbumList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {

                    var loadMoreDatta = edgeGetAlbumsAjaxData(thisAlbumList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();
                    if(nextPage <= maxNumPages){
                        var ajaxData = edgeSetAlbumsAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgeGlobalVars.vars.edgeAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisAlbumList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = response.html;
                                thisAlbumList.waitForImages(function(){
                                    thisAlbumListInner.append(responseHtml);
                                });
                            }
                        });
                    }
                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }
                });

            });
        }
    }

    /**
     * Initializes albums load more data params
     * @param albums list container with defined data params
     * return array
     */
    function edgeGetAlbumsAjaxData(container){
        var returnValue = {};

        returnValue.type = '';
        returnValue.columns = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.label = '';
        returnValue.genre = '';
        returnValue.artist = '';
        returnValue.selectedAlbums = '';
        returnValue.showLoadMore = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.titleTag = '';

        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('label') !== 'undefined' && container.data('label') !== false) {
            returnValue.label = container.data('label');
        }
        if (typeof container.data('genre') !== 'undefined' && container.data('genre') !== false) {
            returnValue.genre = container.data('genre');
        }
        if (typeof container.data('artist') !== 'undefined' && container.data('artist') !== false) {
            returnValue.artist = container.data('artist');
        }
        if (typeof container.data('selected-albums') !== 'undefined' && container.data('selected-albums') !== false) {
            returnValue.selectedAlbums = container.data('selected-albums');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
            returnValue.titleTag = container.data('title-tag');
        }

        return returnValue;
    }


    /**
     * Sets albums load more data params for ajax function
     * @param albums list container with defined data params
     * return array
     */
    function edgeSetAlbumsAjaxData(container){
        var returnValue = {
            action: 'noizzy_music_albums_ajax_load_more',
            type: container.type,
            columns: container.columns,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            label: container.label,
            genre: container.genre,
            artist: container.artist,
            selectedAlbums: container.selectedAlbums,
            showLoadMore: container.showLoadMore,
            nextPage: container.nextPage,
            titleTag: container.titleTag
        };

        return returnValue;

    }

})(jQuery);


(function($) {

    'use strict';

    $(document).ready(function(){
        initSingleArtists();
    });

    // Helper vars and functions.
    function extend( a, b ) {
        for( var key in b ) {
            if( b.hasOwnProperty( key ) ) {
                a[key] = b[key];
            }
        }
        return a;
    }

    /**
     * Record obj.
     */
    function Record(el) {
        this.wrapper = el;
        this.cover = this.wrapper.querySelector('.edge-atrist-image-holder');
        this.position = this.wrapper.querySelector('.edge-artist-desc');
        this.title = this.wrapper.querySelector('.edge-artist-name');
        this.stage = this.wrapper.querySelector('.edge-btn');

        this.info = {
            coverImg : this.cover.querySelector('img').src,
            artist : this.title.innerHTML,
            title : this.stage.innerHTML
        };
    }

    /**
     * Position the record.
     */
    Record.prototype.layout = function(place) {
        switch(place) {
            case 'down' :
                dynamics.css(this.cover, { opacity: 1, translateY : edge.windowHeight });
                dynamics.css(this.position, { opacity: 1, translateY : edge.windowHeight - 200 });
                dynamics.css(this.title, { opacity: 1, translateY : edge.windowHeight - 200 });
                dynamics.css(this.stage, { opacity: 1, translateY : edge.windowHeight - 180 });
                break;
            case 'right' :
                dynamics.css(this.cover, { opacity: 1, translateX : edge.windowWidth + 600 });
                dynamics.css(this.position, { opacity: 1, translateX : edge.windowWidth + 150 });
                dynamics.css(this.title, { opacity: 1, translateX : edge.windowWidth });
                dynamics.css(this.stage, { opacity: 1, translateX : edge.windowWidth + 150 });
                break;
            case 'left' :
                dynamics.css(this.cover, { opacity: 1, translateX : -edge.windowWidth - 600 });
                dynamics.css(this.position, { opacity: 1, translateX : -edge.windowWidth - 150 });
                dynamics.css(this.title, { opacity: 1, translateX : -edge.windowWidth });
                dynamics.css(this.stage, { opacity: 1, translateX : -edge.windowWidth - 150 });
                break;
            case 'hidden' :
                dynamics.css(this.cover, { opacity: 0 });
                dynamics.css(this.position, { opacity: 0 });
                dynamics.css(this.title, { opacity: 0 });
                dynamics.css(this.stage, { opacity: 0 });
                break;
        };
    };

    /**
     * Animate the record.
     */
    Record.prototype.animate = function(direction, callback) {
        var duration = 600,
            type = dynamics.bezier,
            points = [{"x":0,"y":0,"cp":[{"x":0.2,"y":1}]},{"x":1,"y":1,"cp":[{"x":0.3,"y":1}]}],
            transform = {
                'left' : { translateX : -edge.windowWidth, translateY : 0, opacity : 1 },
                'right' : { translateX : edge.windowWidth, translateY : 0, opacity : 1 },
                'center' : { translateX : 0, translateY : 0, opacity : 1 }
            };

        dynamics.animate(this.cover, transform[direction], { duration : duration, type : type, points : points, complete : function() {
                if( typeof callback === 'function' ) {
                    callback();
                }
            } });
        dynamics.animate(this.position, transform[direction], { duration : duration, type : type, points : points });
        dynamics.animate(this.title, transform[direction], { duration : duration, type : type, points : points });
        dynamics.animate(this.stage, transform[direction], { duration : duration, type : type, points : points });
    };

    /**
     * Slideshow obj.
     */
    function RecordSlideshow(el, options) {
        this.el = el;

        // Options/Settings.
        this.options = extend( {}, this.options );
        extend( this.options, options );

        // Slideshow items.
        this.records = [];
        var self = this;
        [].slice.call(this.el.querySelectorAll('.edge-atrist-single')).forEach(function(el) {
            var record = new Record(el);
            self.records.push(record);
        });
        // Total items.
        this.recordsTotal = this.records.length;
        // Current record idx.
        this.current = 0;
        // Slideshow controls.
        this.ctrls = {
            next : this.el.querySelector('.edge-controls-navigate > span.edge-control-button-next'),
            prev : this.el.querySelector('.edge-controls-navigate > span.edge-control-button-prev'),
            back : this.el.querySelector('span.edge-control-button-back')
        };

        this._initEvents();
    }

    /**
     * RecordSlideshow options/settings.
     */
    RecordSlideshow.prototype.options = {
        // On stop callback.
        onStop : function() { return false; }
    };

    /**
     * Shows the first record.
     */
    RecordSlideshow.prototype.start = function(pos) {
        this.current = pos;
        var currentRecord = this.records[this.current];
        $(currentRecord.wrapper).addClass('edge-single-current');
        $('.edge-page-header, .edge-page-footer').css('zIndex', '0');
        currentRecord.layout('down');
        currentRecord.animate('center');
    };

    /**
     * Init/Bind events.
     */
    RecordSlideshow.prototype._initEvents = function() {
        var self = this;
        this.ctrls.next.addEventListener('click', function() {
            self._navigate('right');
        });
        this.ctrls.prev.addEventListener('click', function() {
            self._navigate('left');
        });
        this.ctrls.back.addEventListener('click', function() {
            self._stop();
        });

    };

    /**
     * Navigate.
     */
    RecordSlideshow.prototype._navigate = function(direction) {

        var currentRecord = this.records[this.current];

        if( direction === 'right' ) {
            this.current = this.current < this.recordsTotal - 1 ? this.current + 1 : 0;
        }
        else {
            this.current = this.current > 0 ? this.current - 1 : this.recordsTotal - 1;
        }

        var nextRecord = this.records[this.current];
        $(nextRecord.wrapper).addClass('edge-single-current');

        currentRecord.animate(direction === 'right' ? 'left' : 'right', function() {
            $(currentRecord.wrapper).removeClass('edge-single-current');
        });

        nextRecord.layout(direction);
        nextRecord.animate('center');
    };

    /**
     * Stop the slideshow.
     */
    RecordSlideshow.prototype._stop = function() {
        edge.modules.common.edgeDisableScroll();
        var currentRecord = this.records[this.current];
        currentRecord.layout('hidden');
        $(currentRecord.wrapper).removeClass('edge-single-current');
        $('.edge-page-header, .edge-page-footer').css('zIndex', '');

        // Callback.
        this.options.onStop();
    };

    /* UI */

    // Single/Slideshow views.
    if(document.querySelector('.edge-artists-list-holder-outer') !== null) {
        var views = {
                list: document.querySelector('.edge-artists-list-holder'),
                single: document.querySelector('.edge-artist-view-single')
            },
            // The initial list items.
            lps = [].slice.call(views.list.querySelectorAll('.edge-artist')),
            expanderEl = document.querySelector('.edge-artist-single-expander'),
            slideshow;
    }

    /**
     * Initialize events.
     */
    function initSingleArtists() {
        if(document.querySelector('.edge-artists-list-holder-outer') !== null) {
            initEvents();
            // Initialize slideshow.
            slideshow = new RecordSlideshow(document.querySelector('.edge-artist-view-single'), {
                // Stopping/Closing the slideshow: return to the initial list.
                onStop: function () {
                    changeView('single', 'list');
                    hideExpander();
                    edge.modules.common.edgeEnableScroll();
                }
            });
        }
    }

    function changeView(old, current) {
        $(views[old]).removeClass('edge-view-current');
        $(views[current]).addClass('edge-view-current');
    }

    function initEvents() {
        lps.forEach(function(lp, pos) {
            $(lp).on('click', function(e) {
                e.preventDefault();
                edge.modules.common.edgeDisableScroll();

                showExpander({x: e.clientX, y: e.clientY}, function() {
                    changeView('list', 'single');
                });
                // Start the slideshow.
                setTimeout(function() { slideshow.start(pos);}, 80);
            });
        });
    }

    function showExpander(position, callback) {
        $(expanderEl).addClass('active');
        edge.body.addClass('edge-records-slideshow-active');

        dynamics.css(expanderEl, { opacity: 1, left : position.x, top : position.y, backgroundColor : '#f4f4f4', scale : 0 });
        dynamics.animate(expanderEl, {
            scale : 1.5,
            backgroundColor : '#f4f4f4'
        }, {
            duration : 500,
            type : dynamics.easeOut,
            complete : function() {
                if( typeof callback === 'function' ) {
                    callback();
                }
            }
        });
        $('.edge-page-header, .edge-vertical-menu-area, .edge-page-footer').css('zIndex', 0);
        $('html').addClass('qodef-expander-disable-scroll');
    }

    function hideExpander() {
        dynamics.css(expanderEl, { left : window.innerWidth/2, top : window.innerHeight/2 });
        dynamics.animate(expanderEl, {
            opacity : 0
        }, {
            duration : 500,
            type : dynamics.easeOut,
            complete: function(){
                $(expanderEl).removeClass('active');
                edge.body.removeClass('edge-records-slideshow-active');
            }
        });
        $('.edge-page-header, .edge-vertical-menu-area, .edge-page-footer').css('zIndex', '');
        $('html').removeClass('qodef-expander-disable-scroll');
    }


})(jQuery);
(function($) {
    'use strict';

    var artistsSlider = {};
    edge.modules.artistsSlider = artistsSlider;

    artistsSlider.edgeOnDocumentReady = edgeOnDocumentReady;
    artistsSlider.edgeOnWindowLoad = edgeOnWindowLoad;
    artistsSlider.edgeOnWindowResize = edgeOnWindowResize;
    artistsSlider.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {
        edgeArtistsSliderHover();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    function edgeArtistsSliderHover() {

        if ( $('.edge-artists-slider').length ) {
            $('.edge-artists-slider').each(function(){
                var $this = $(this);

                // check for mouseWheel option and enables functionality
                var mouseWheelEnabled = $this.data('slider-mousewheel');

                if ( mouseWheelEnabled !== 'undefined' && mouseWheelEnabled === 'yes') {

                    // allow one mousewheel each 0.5 second
                    var timestamp_mousewheel = 0; //Define if not in a function

                    $this.on("mousewheel", ".owl-stage", function (e) {
                        var d = new Date();

                        /*on mousewheel event compare two times to allow event every 0.5 second*/
                        if ((d.getTime() - timestamp_mousewheel) > 500) {

                            /*acquire new time for comparison*/
                            timestamp_mousewheel = d.getTime();

                            if (e.deltaY > 0) {
                                $this.trigger('next.owl');
                            } else {
                                $this.trigger('prev.owl');
                            }
                            e.preventDefault();
                        }
                    });
                }

                var showActiveSlideInfo = function() {
                    $this.find('.active').each(function(){
                        var $info = $(this).find('.edge-artist-info').html();
                        $(this).on('mousemove', function(e){

                            if($(this).hasClass('active')) {

                                $('.edge-artists-slider-info').html($info)
                                $('.edge-artists-slider-info').css({
                                    top: e.clientY,
                                    left: e.clientX,
                                    opacity: 1
                                });
                            }
                        });

                        $(this).on('mouseleave', function(){
                            $('.edge-artists-slider-info').css('opacity', 0);
                        });
                    });
                }

                /*init once to show info on firs active slide before translate*/
                showActiveSlideInfo();

                /*init function after translation of slider*/
                $this.on('translated.owl.carousel', function(){
                    showActiveSlideInfo();
                });

            });

        }
    }

})(jQuery);
(function($) {
    'use strict';

    var eventsList = {};
    edge.modules.eventsList = eventsList;

    eventsList.edgeOnDocumentReady = edgeOnDocumentReady;
    eventsList.edgeOnWindowLoad = edgeOnWindowLoad;
    eventsList.edgeOnWindowResize = edgeOnWindowResize;
    eventsList.edgeOnWindowScroll = edgeOnWindowScroll;

    $(document).ready(edgeOnDocumentReady);
    $(window).on('load', edgeOnWindowLoad);
    $(window).resize(edgeOnWindowResize);
    $(window).scroll(edgeOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function edgeOnDocumentReady() {

    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function edgeOnWindowLoad() {
        edgeInitEventsLoadMore();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function edgeOnWindowResize() {
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function edgeOnWindowScroll() {
    }

    /**
     * Initializes events load more function
     */
    function edgeInitEventsLoadMore(){

        var eventsList = $('.edge-events-list-holder-outer.edge-events-load-more');

        if(eventsList.length){
            eventsList.each(function(){

                var thisEventList = $(this);
                var thisEventListInner = thisEventList.find('.edge-events-list-holder');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisEventList.find('.edge-events-list-load-more a');
                var loadMoreButtonHolder = thisEventList.find('.edge-events-list-paging');

                if ( thisEventList.find('.edge-grid').length ) {
                    thisEventListInner = thisEventList.find('.edge-grid');
                }

                if (typeof thisEventList.data('max-num-pages') !== 'undefined' && thisEventList.data('max-num-pages') !== false) {
                    maxNumPages = thisEventList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {
                    var loadMoreDatta = edgeGetEventsAjaxData(thisEventList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();
                    if(nextPage <= maxNumPages){
                        loadMoreButtonHolder.find('.edge-events-list-load-more').stop().animate({opacity:0}, 200, 'easeInOutQuint',
                            function(){
                                loadMoreButtonHolder.find('.edge-stripes').stop().animate({opacity:1},200, 'easeInOutQuint');
                            });
                        var ajaxData = edgeSetEventsAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: edgeGlobalVars.vars.edgeAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisEventList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = response.html;

                                thisEventList.waitForImages(function(){
                                    thisEventListInner.append(responseHtml);
                                    loadMoreButtonHolder.find('.edge-stripes').stop().animate({opacity:0}, 200, 'easeInOutQuint',
                                        function(){
                                            loadMoreButtonHolder.find('.edge-events-list-load-more').stop().animate({opacity:1},200, 'easeInOutQuint');
                                            if(nextPage > maxNumPages){
                                                loadMoreButtonHolder.find('.edge-stripes').remove();
                                                loadMoreButtonHolder.fadeOut(200, 'easeInOutQuint').remove();
                                            }
                                        });
                                });
                            }
                        });
                    } else {
                        loadMoreButtonHolder.hide();
                    }
                });

            });
        }
    }

    /**
     * Initializes events load more data params
     * @param events list container with defined data params
     * return array
     */
    function edgeGetEventsAjaxData(container){
        var returnValue = {};

        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.showLoadMore = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.titleTag = '';
        returnValue.buttonShape = '';
        returnValue.textColor = '';
        returnValue.skin = '';
        returnValue.borderColor = '';
        returnValue.eventStatus = '';
        returnValue.layout = '';

        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('button-shape') !== 'undefined' && container.data('button-shape') !== false) {
            returnValue.buttonShape = container.data('button-shape');
        }
        if (typeof container.data('skin') !== 'undefined' && container.data('skin') !== false) {
            returnValue.skin = container.data('skin');
        }
        if (typeof container.data('text-color') !== 'undefined' && container.data('text-color') !== false) {
            returnValue.textColor = container.data('text-color');
        }
        if (typeof container.data('border-color') !== 'undefined' && container.data('border-color') !== false) {
            returnValue.borderColor = container.data('border-color');
        }
        if (typeof container.data('event-status') !== 'undefined' && container.data('event-status') !== false) {
            returnValue.eventStatus = container.data('event-status');
        }
        if (typeof container.data('layout') !== 'undefined' && container.data('layout') !== false) {
            returnValue.layout = container.data('layout');
        }

        return returnValue;
    }


    /**
     * Sets events load more data params for ajax function
     * @param events list container with defined data params
     * return array
     */
    function edgeSetEventsAjaxData(container){
        var returnValue = {
            action: 'noizzy_music_events_ajax_load_more',
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            showLoadMore: container.showLoadMore,
            nextPage: container.nextPage,
            titleTag: container.titleTag,
            buttonShape: container.buttonShape,
            skin: container.skin,
            textColor: container.textColor,
            borderColor: container.borderColor,
            eventStatus: container.eventStatus,
            layout: container.layout
        };

        return returnValue;

    }

})(jQuery);
(function($) {
	'use strict';
	
	var albumDisc = {};
	edge.modules.albumDisc = albumDisc;
	
	albumDisc.edgeInitAlbumDisc = edgeInitAlbumDisc;
	
	
	albumDisc.edgeOnDocumentReady = edgeOnDocumentReady;
	
	$(document).ready(edgeOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgeOnDocumentReady() {
		edgeInitAlbumDisc();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgeInitAlbumDisc() {
        var albumDiscs = $('.edge-album-disc.edge-animate-on-appear');

        if (albumDiscs.length) {
            albumDiscs.each(function(){
            var albumDisc = $(this);

            //vss
            if (albumDisc.closest('.edge-vss-ms-section').length) {
                if (albumDisc.closest('.edge-vss-ms-section').hasClass('active') && !albumDisc.hasClass('edge-appeared')) {
                    setTimeout(function(){
                        albumDisc.addClass('edge-appeared');
                    }, 500); 
                    //duration of a slide
                }
            } 
            //scroll
            else {
                albumDisc.appear(function(){
                    albumDisc.addClass('edge-appeared');
                },{accX: 0, accY: edgeGlobalVars.vars.edgeElementAppearAmount});
            }

            }); 
        }
    }
	
})(jQuery);