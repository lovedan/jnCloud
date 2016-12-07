<!-- Back to top Link -->
<a id="to-top" href="#"><span class="fa fa fa-angle-up"></span></a>

<!-- Load JS plugins -->
<script type="text/javascript" src="assets/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="assets/js/assets.js"></script>

<!-- SLIDER REVOLUTION  -->
<script type="text/javascript" src="assets/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
    (Load Extensions only on Local File Systems !  +
    The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="assets/js/revolution.extension.actions.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.kenburn.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.migration.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="assets/js/revolution.extension.video.min.js"></script>
<!-- END SLIDER REVOLUTION 5.0 EXTENSIONS -->
<script type="text/javascript">
    var tpj=jQuery;
    var revapi70;
    tpj(window).load(function() {
        if(tpj("#slider").revolution == undefined){
            revslider_showDoubleJqueryError("#slider");
        }else{
            revapi70 = tpj("#slider").show().revolution({
                sliderType:"standard",
                jsFileLocation:"assets/js/",
                sliderLayout:"fullwidth",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"off",
                    touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    }
                    ,
                    arrows: {
                        style:"zeus",
                        enable:true,
                        hide_onmobile:true,
                        hide_under:600,
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        tmp:'<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
                        left: {
                            h_align:"left",
                            v_align:"center",
                            h_offset:30,
                            v_offset:0
                        },
                        right: {
                            h_align:"right",
                            v_align:"center",
                            h_offset:30,
                            v_offset:0
                        }
                    }
                },
                responsiveLevels:[1200,1024,768,480],
                gridwidth:[1200,1024,768,480],
                gridheight:[600,600,960,720],
                lazyType:"none",
                parallax: {
                    type:"mouse+scroll",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[1,2,3,20,25,30,35,40,45,50],
                    disable_onmobile:"on"
                },
                shadow:0,
                spinner:"spinner2",
                autoHeight:"off",
                disableProgressBar:"on",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    disableFocusListener:false,
                }
            });
        }
    });	/*ready*/
</script>

<!-- general script file -->
<script type="text/javascript" src="assets/js/script.js"></script>