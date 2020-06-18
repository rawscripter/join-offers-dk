/**
 * æ”¾å¤§é•œæ’ä»¶     v1.1.0
 * @mail cj_zheng1023@hotmail.com
 * @author AfterWin
 *
 *
 *
 * update log
 *
 * 2017.5.30    ä¿®æ”¹é€šè¿‡è¯·æ±‚èŽ·å–çš„å›¾ç‰‡èŽ·å–ä¸åˆ°é«˜å®½çš„é—®é¢˜   v.1.1.0
 *
 */
(function($){

    var SPACING = 15;
    //var ZOOM_TIMES = 10;





    $.fn.jqZoom = function(options){
        $(this).each(function(i, dom){
            var me = $(dom);
            _initZoom(me, options.selectorWidth, options.selectorHeight);
            var imgUrl = options&&options.zoomImgUrl?options.zoomImgUrl:me.attr("src");
            _initViewer(me, imgUrl, options.viewerWidth, options.viewerHeight);
        })
    }

    /**
     * åˆå§‹åŒ–èšç„¦æ¡†
     * @param target     å›¾ç‰‡jqueryå¯¹è±¡
     * @param sWidth     èšç„¦åŒºåŸŸå®½åº¦
     * @param sHeight    èšç„¦åŒºåŸŸé•¿åº¦
     * @private
     */
    var _initZoom = function(target, sWidth, sHeight){
        var $zoom = $("<div />").addClass("zoom-selector").width(sWidth).height(sHeight);
        target.after($zoom);
        target.closest(".zoom-box").on({
            mousemove: function(e){
                var mouseX=e.pageX-$(this).offset().left;
                var mouseY=e.pageY-$(this).offset().top;
                var halfSWidth = sWidth/ 2,halfSHeight = sHeight/2;
                var realX, realY;
                if(mouseX < halfSWidth){
                    realX = 0;
                }else if(mouseX + halfSWidth > target.width()){
                    realX = target.width() - sWidth;
                }else{
                    realX = mouseX - halfSWidth;
                }
                if(mouseY < halfSHeight){
                    realY = 0;
                }else if(mouseY + halfSHeight > target.height()){
                    realY = target.height() - sHeight;
                }else{
                    realY = mouseY - halfSHeight;
                }
                $zoom.css({
                    left: realX,
                    top: realY
                })
                var viewerX = realX*($(this).find(".viewer-box>img").width() - $(this).find(".viewer-box").width())/(target.width() - sWidth);
                var viewerY = realY*($(this).find(".viewer-box>img").height() - $(this).find(".viewer-box").height())/(target.height() - sHeight);
                $(this).find(".viewer-box>img").css({
                    left: -viewerX,
                    top: -viewerY
                })
            },
            mouseenter: function(){
                $zoom.css("display", "block");
                $(this).find(".viewer-box").css("display", "block");
            },
            mouseleave: function(){
                $zoom.css("display", "none");
                $(this).find(".viewer-box").css("display", "none");
            }
        })
    }
    /**
     *åˆå§‹åŒ–æ”¾å¤§åŒºåŸŸ
     * @param target       å›¾ç‰‡jqueryå¯¹è±¡
     * @param imgUrl      åŽŸå§‹å›¾ç‰‡URL
     * @param vWidth      æ”¾å¤§åŒºåŸŸå®½åº¦
     * @param vHeight     æ”¾å¤§åŒºåŸŸé•¿åº¦
     * @private
     */
    var _initViewer = function(target, imgUrl, vWidth, vHeight){
        var $viewer = $("<div />").addClass("viewer-box").width(vWidth).height(vHeight);
        var $zoomBox = target.closest(".zoom-box");
        $viewer.css({
            left: target.width() + SPACING,
            top: 0
        })
        _setOriginalSize(target, function(oWidth, oHeight){
            var $img = $("<img src='"+imgUrl+"' />").width(oWidth).height(oHeight);
            $viewer.append($img);
            target.after($viewer);
        });
    }
    /**
     * è®¾ç½®å›¾ç‰‡åŽŸå§‹å®½é«˜
     * @param target       å›¾ç‰‡jqueryå¯¹è±¡
     * @param callback     é€šè¿‡å›žè°ƒå‡½æ•°è®¾ç½®åŽŸå§‹å®½é«˜
     * @returns {{oWidth: Number, oHeight: Number}}
     * @private
     */
    var _setOriginalSize = function(target, callback){
        var newImg = new Image();
        newImg.src = target.attr("src")+"?date="+new Date();
        $(newImg).on("load", function(){
            callback(newImg.width, newImg.height);
        })
    }

})(jQuery);
