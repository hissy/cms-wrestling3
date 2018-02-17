/* ------------------------------------------------------------------

 common.js
	
------------------------------------------------------------------ */


//
// スマホメインイメージのリサイズ処理
//



jQuery(function($){
		$(window).bind("resize load",function(){
				winWidth = $(window).width();
			if(winWidth < 640){
			$("body").addClass("sp_index");
			$(".sp_index #main_img .main_bg1").css("height",winWidth / 2);
			}
			else if(winWidth > 640){
			$("body").removeClass("sp_index");
			$("#main_img .main_bg1").css("height",400);
			}
		}); 
});


//
// TOP バナー とか画面サイズを変えた時の動き処理色々
//

jQuery(function($){
		$(window).bind("resize load",function(){
				winWidth = $(window).width();
			if(winWidth < 640){
			$(".ct_right .link_list li a").removeAttr("style");
			$(".course1_height").removeAttr("style");
			$(".guide_height").removeAttr("style");
   $("#ct_right .img_list li").removeAttr("style");
   $("#main_img p:first-child").show();
   $("#main_img p:gt(0)").hide();
			$(".course1_height").removeAttr("style");
			}
			else{
				$(".auto_height2").autoHeight({column:2, clear:1});
				$(".ct_right .link_list li a").autoHeight({column:2, clear:1});
				$(".course1_height").autoHeight({column:2, clear:1});
				$(".guide_height").autoHeight({column:3, clear:1});
				$("#ct_right .img_list ul li").autoHeight({column:2, clear:1});
			}
		}); 
});


//
// 高さを自動で合わせる
//

$(function($){
							$(".ct_right .link_list li a").removeAttr("style");
							$(".course1_height").removeAttr("style");
							$("#ct_right .img_list li").removeAttr("style");
							$("#ft .ft_nav ul").removeAttr("style");
							setTimeout(function(){
							$(".arw_list li").autoHeight({column:2, clear:1});
							$(".auto_height2").autoHeight({column:2, clear:1});
							$("#ft .ft_nav ul").autoHeight({column:8, clear:1});
							$(".university_list1 li a").autoHeight({column:2, clear:1});
							$(".ct_right .link_list li a").autoHeight({column:2, clear:1});
							$(".guide_height").autoHeight({column:3, clear:1});
							$("#ct_right .img_list ul li").autoHeight({column:2, clear:1});
							},1000);
});


//
// clickで高さを合わせる
//

$(function($){
	$("#font_change li").click(function(){
			$(".auto_height2").removeAttr("style");
		setTimeout(function(){
			$(".auto_height2").autoHeight({column:2, clear:1});
		},1000);
	});
});



/* --------------------------------------------------------------------------------------
 グロナビ
--------------------------------------------------------------------------------------- */

/* ナビの高さをあわせる ------------------------------ */

$(function(){
	
	$("#hd ul li").hover(function() {
		setTimeout(function(){
			$("#gnav1 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav2 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav3 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav4 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav5 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav6 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav7 .sub ul.large_link li").autoHeight({column:3, clear:1});
			$("#gnav8 .sub ul.large_link li").autoHeight({column:3, clear:1});
		
			$("#gnav1 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav2 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav3 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav4 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav5 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav6 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav7 .sub ul.small_link li").autoHeight({column:3, clear:1});
			$("#gnav8 .sub ul.small_link li").autoHeight({column:3, clear:1});
		},500);
	});
});



$(function($){
					$('li','#font_change').bind("click load",function(){
							$(".ct_right .link_list li a").removeAttr("style");
							$(".course1_height").removeAttr("style");
							$(".guide_height").removeAttr("style");
							$("#ct_right .img_list li").removeAttr("style");
							$("#ft .ft_nav ul").removeAttr("style");
							setTimeout(function(){
							$(".auto_height2").autoHeight({column:2, clear:1});
							$("#ft .ft_nav ul").autoHeight({column:8, clear:1});
							$(".university_list1 li a").autoHeight({column:2, clear:1});
							$(".ct_right .link_list li a").autoHeight({column:2, clear:1});
							$(".course1_height").autoHeight({column:2, clear:1});
							$(".guide_height").autoHeight({column:3, clear:1});
							$("#ct_right .img_list ul li").autoHeight({column:2, clear:1});
							},1000);
					});
});

//
// フォントサイズ変更
//

jQuery(function($){
//変数にクッキー名を入れる
var history = $.cookie('font_size');
//適用する箇所を指定。今回は部分的に#test内のpに
var elm = $('html');
//変数が空ならfont_mを、空でなければクッキーに保存しておいたものを適用
(!history)? elm.addClass('font_m'):elm.addClass(history);
	//クリックしたら実行
	$('li','#font_change').click(function(){
	//クリックした要素のID名を変数にセット
	var setfont_size = this.id;
	//クッキーに変数を保存
	$.cookie('font_size', setfont_size,{expires:30,path:'/'});
	//一度classを除去して、変数をclassとして追加
	elm.removeClass().addClass(setfont_size);
	});
});

//
// リロードランダム
//

this.randomtip = function(){
 $("#main_img p").hide();
	var length = $("#main_img p").length; // this is where we put the id of the list
	var ran = Math.floor(Math.random()*length) + 1;
	$("#main_img p:nth-child(" + ran + ")").show();
};

$(function(){
				randomtip();
});


//
// フォームテキストエリア内
//

$(function(){
     $(".focus").focus(function(){
          if(this.value == "Search"){
               $(this).val("").css("color","#333333");
          }
     });
     $(".focus").blur(function(){
          if(this.value == ""){
               $(this).val("Search").css("color","#cccccc");
          }
     });
});

$(function(){
	$(window).load(function() {
		$("div#hd .hd_other .gsc-search-box #gs_id1").removeAttr("style");
		$(".gsc-input-box-hover input,.gsc-input-box-focs input").removeAttr("style");
		$(".gsc-search-button input").removeAttr("type");
});
});


//
//アコーディオン：閉じて開く PC
//

$(function(){
	$(".sub").hide();
	$(".gnav > li").hover(function(){
		$(this).children(".sub").show();
	},function(){
		$(this).children(".sub").hide();
	});
});


//
//アコーディオン：閉じて開く SP
//

$(function(){
$("#hd_menu").hide();
$(".hd_nav_sp").click(function(){
$("#hd_sp").find("#hd_menu").slideToggle();
$("#hd_sp").find("#hd_search").slideUp();
});
});

$(function(){
$("#hd_search").hide();
$("#hd_btn .search_area_sp").click(function(){
$("#hd_sp").find("#hd_search").slideToggle();
$("#hd_sp").find("#hd_menu").slideUp();
});
$("#hd_search .btn_close").click(function(){
$("#hd_sp").find("#hd_search").slideUp();
$("#hd_sp").find("#hd_menu").slideUp();
});
});


$(function(){
$("#ft_menu").hide();
$(".ft_nav_sp").click(function(){
$("#ft_sp").find("#ft_menu").slideToggle();
$("#ft_sp").find("#ft_search").slideUp();
});
});

$(function(){
$("#ft_search").hide();
$("#ft_sp .search_area_sp").click(function(){
$("#ft_sp").find("#ft_search").slideToggle();
$("#ft_sp").find("#ft_menu").slideUp();
});
$("#ft_sp .btn_close").click(function(){
$("#ft_sp").find("#ft_search").slideUp();
$("#ft_sp").find("#ft_menu").slideUp();
});
});



//
//SmoothScroll
//

$(function(){
// #で始まるアンカーをクリックした場合に処理
$('a[href^=#]').click(function() {
	// スクロールの速度
	var speed = 1000;// ミリ秒
	// アンカーの値取得
	var href= $(this).attr("href");
	// 移動先を取得
	var target = $(href == "#" || href == "" ? 'html' : href);
	// 移動先を数値で取得
	var position = target.offset().top;
	// スムーススクロール
	$($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'easeOutExpo');
	return false;
});
});

//
//RollOver
//
;(function($){
$(document).ready(function(){
$("a img[src*='_ov']").addClass("current");
$("a img[class!='current'],:image").mouseover(function(){
if ($(this).attr("src").match(/_ot./)){
$(this).attr("src",$(this).attr("src").replace("_ot.", "_ov."));
return;
}
}).mouseout(function(){
if ($(this).attr("src").match(/_ov./)){
$(this).attr("src",$(this).attr("src").replace("_ov.", "_ot."));
return;
}
}).click(function(){
if ($(this).attr("src").match(/_ov./)){
$(this).attr("src",$(this).attr("src").replace("_ov.", "_ot."));
return;
}
});


//preload images
var images = [];
$("a img,:image").each(function(index){
	var src = $(this).attr("src");
	if (src) {
        if (src.match(/_ot./)) {
            images[index] = new Image();
            images[index].src = $(this).attr("src").replace("_ov.", "_ot.");
        }
    }
});
});
})(jQuery);

//
//TOP PlumGardenバナーテキスト文字数制限
//
$(function(){
	if($('.plumgarden_box .txt .ttl a').length > 0){
		$(window).bind('load resize', function(){
			var winW = $(window).width();
			if(winW > 640){
	  			var count = 32;
			}else{
				var count = 23;	
			}
			$('.plumgarden_box .txt .ttl a').each(function(){
				var target = $('span',this),
				fullTxt = target.text();
				if(fullTxt.length > count){
					$(this).html(fullTxt.substr(0,count) + '…' + '<span style="display:none;">' + fullTxt + '</span>');
				}else{
					$(this).html('<span>' + fullTxt + '</span>');
				}
			});
			$('.plumgarden_box .txt .ttl').css("display", "block");
		});
	}
});


//
//教員紹介　段落ち調整
//
$(function(){
	$('.teacher_area').each(function(){
			var linksnum = $(this).children('p').eq(2).css('clear','both');
			/*if(linksnum > 2){
					alert($(this).children('p').attr('style').length);
			}*/
	});
	$('.teacher_area .name_link, .teacher_area .link_arw1').each(function(){
		if($(this).width() > 160){
				$(this).css('clear','both');
				$(this).next().css('clear','both');
				$(this).next().next().removeAttr("style");
		}
	});
});
