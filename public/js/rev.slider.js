var dzrevapi;
var dzQuery =jQuery;
function dz_rev_slider_1(){
	if(dzQuery("#rev_slider_265_1").revolution == undefined){
	  revslider_showDoubleJqueryError("#rev_slider_265_1");
	}else{
	  dzrevapi = dzQuery("#rev_slider_265_1").show().revolution({
		sliderType:"standard",
		sliderLayout:"fullwidth",
		dottedOverlay:"none",
		delay:9000,
		navigation: {
			keyboardNavigation: "on",
			keyboard_direction: "horizontal",
			mouseScrollNavigation: "off",
			onHoverStop: "off",
			touch: {
				touchenabled: "on",
				swipe_threshold: 75,
				swipe_min_touches: 1,
				swipe_direction: "horizontal",
				drag_block_vertical: false
			},
			arrows: {
				style: "gyges",
				enable: true,
				hide_onmobile: false,
				hide_onleave: false,
				tmp: '',
				left: {
					h_align: "left",
					v_align: "center",
					h_offset: 10,
					v_offset: 0
				},
				right: {
					h_align: "right",
					v_align: "center",
					h_offset: 10,
					v_offset: 0
				}
			},
		},
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1920,
		gridheight:766,
		lazyType:"none",
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
		  simplifyAll:"off",
		  nextSlideOnWindowFocus:"off",
		  disableFocusListener:false,
		}
	  });
	}
}