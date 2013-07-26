var username;
var table_prefix;
var tec_value;

$(function() {
	
	// 
	// detail panel 
	// 
	var last;
	var lastID;
				

    ////////////////////////////////////////////////////////////////
    // back to top
    $(window).scroll(function() {
		if($(this).scrollTop() != 0) {
			$('#backtotop').fadeIn();
		} else {
			$('#backtotop').fadeOut();
		}
	});

	$('#backtotop').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});



    ////////////////////////////////////////////////////////////////
    $('.assocDetailClose').live({
    	click: function() {
    		$(this).parent().empty();
    	}
    });


    $('#tree_item').live({
    	mouseover:
	    	function() {
		    	$(this).addClass('tree_item_hover');
		    }, 
		mouseout:
		    function() {
		    	$(this).removeClass();
		    },
		click:
			function() {
				$(this).removeClass();
				$('#tree_item_active').attr('id', 'tree_item');
				$(this).attr('id', 'tree_item_active');
				// $('#search-tmp').css('margin-top', ($(this).offset().top - 150));
				contentID = $(this).find('span').attr('href');
				if(contentID) {
					window.parent.$('body').animate({scrollTop: $(contentID).offset().top - 20}, 300 );

				}
				iframe = $(parent.document.getElementById('load-div'));
				// searchTmp_height = $('#search-tmp').height;
				// console.log(searchTmp_height);
				// container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;



				// iframe.css('height', searchTmp_height + 'px');	
				// $('.config_treeview').css('margin-top', ($(contentID).offset().top -150));
				// console.log($(this).offset().top + ', ' + $('#search-tmp').find('.search').height());
				// $('#iframe-size').html($(this).offset().top + $('#search-tmp').height() + 500);
			}
    });

    $('#tree_item_match').live({
    	mouseover:
	    	function() {
		    	$(this).addClass('tree_item_match_hover');
		    }, 
		mouseout:
		    function() {
		    	$(this).removeClass();
		    },
		click:
			function() {
				$(this).removeClass();
				$('#tree_item_match_active').attr('id', 'tree_item_match');
				$(this).attr('id', 'tree_item_match_active');
			}
    });



	$('#loading1').hide();
	$('#loading2').hide();
	$('#form-content').hide();

	$('#search-normal').click(function() {
		if (!$('#search-result').is(':empty')) {
			$('#search-result').empty();
		}
		if ($('#search-text').val()) {
			$('#search-text').val('');
		}
		$('#searchForm').css('display', 'none');
		$('#searchFormAdvance').css('display', 'block');
		$('#form-content').hide();
	});
	$('#search-advance').click(function() {
		if (!$('#search-result').is(':empty')) {
			$('#search-result').empty();
		}
		if ($('#search-advance-text').val()) {
			$('#search-advance-text').val('');
		}
		$('#searchFormAdvance').css('display', 'none');
		$('#searchForm').css('display', 'block');
		$('#form-content').hide();
	});

	$("#searchForm").submit(function(event) {
		event.preventDefault();
		if ($('#search-instruct').length) {
			$('#search-instruct').remove();
		}
		var user = username; 
		var prefix = table_prefix;
		var ts = true;
		var tec = tec_value;
		var content = $.trim($('#search-text').val());
		if ($('#search-reg-check').is(':checked')) {
			var regex = true;
		}
		else {
			var regex = false;
		}


		$('#search-bn').html('&nbsp;');
		$('#search-bn').attr('id', 'loading1');

		$.ajax({
			url: "../searchHandler",
			data: {user: user,
					prefix: prefix,
					ts: ts,
					content: content,
					regex: regex,
					tec: tec
			},
			success:function(response) {

				$('#loading1').attr('id', 'search-bn');
				$('#search-bn').html('<i class="icon-search"></i>');

				$('#search-result').empty();
				$('#search-result').html(response);
				$('#form-content').show();

				$('.nav-sub-fixed').css('background-color', 'white');
				var iframe = $(parent.document.getElementById('load-div'));
				container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;
				iframe.css('height', container_height + 'px');
			}
		});
	});

	var last;
	$('#listResult li').live('click', function(e) {
		e.preventDefault();
		if (last) {
			if (last.html() == 'admin display-config') {
				// $('#search-tmp').find(last.attr('href')).parent().parent().css('display', 'none');
				// $('#search-tmp').find(last.attr('href')).parent().parent().parent().css('display', 'none');
				$('#search-tmp').find(last.attr('href')).parents('.search-tmp-div').css('display', 'none');
				// $('#eagle-view').find(last.attr('ev')).parent().parent().parent().css('display', 'none');
				$('#eagle-view').find(last.attr('ev')).parents('.eagle-view-div').css('display', 'none');
				// $('#eagle-view').find(last.attr('ev')).parents('.eagle-view-div').css('position', 'relative');
			} else {
				// $('#search-tmp').find(last.attr('href')).parent().parent().css('display', 'none');
				$('#search-tmp').find(last.attr('href')).parents('.search-tmp-div').css('display', 'none');
				// $('#eagle-view').find(last.attr('ev')).parent().parent().parent().css('display', 'none');
				$('#eagle-view').find(last.attr('ev')).parents('.eagle-view-div').css('display', 'none');
				// $('#eagle-view').find(last.attr('ev')).parents('.eagle-view-div').css('position', 'relative');
			}
			
		}
		var here = $(this);
		last = here;
		setTimeout($('#search-tmp').scrollTop(), 10);
		$('#search-toolbar').css('display', 'block');

		if (here.html() == 'admin display-config') {
			// $('#search-tmp').find(here.attr('href')).parent().parent().css('display', 'block');
			// $('#search-tmp').find(here.attr('href')).parent().parent().parent().css('display', 'block');
			$('#search-tmp').find(here.attr('href')).parents('.search-tmp-div').css('display', 'block');
			// $('#eagle-view').find(here.attr('ev')).parent().parent().parent().css('display', 'block');
			$('#eagle-view').find(here.attr('ev')).parents('.eagle-view-div').css('display', 'block');
			// $('#eagle-view').find(here.attr('ev')).parents('.eagle-view-div').css('position', 'fixed');
		} else {
			// $('#search-tmp').find(here.attr('href')).parent().parent().css('display', 'block');
			$('#search-tmp').find(here.attr('href')).parents('.search-tmp-div').css('display', 'block');
			// $('#eagle-view').find(here.attr('ev')).parent().parent().parent().css('display', 'block');
			$('#eagle-view').find(here.attr('ev')).parents('.eagle-view-div').css('display', 'block');
			// $('#eagle-view').find(here.attr('ev')).parents('.eagle-view-div').css('position', 'fixed');
		}
		
		// $('#search-tmp').scrollTop($(here.attr('href')).offset().top-$('#search-tmp').offset().top);
	});

	$('#eagle-view li').live('click', function(e) {
		e.preventDefault();
		
		var here = $(this);
		// here.parents('.eagle-view-div').css('position', 'fixed');
		// $('#search-tmp').scrollTop(0);
		// setTimeout($('#search-tmp').scrollTop(0), 50);
		// $('#search-tmp').scrollTop($(here.attr('href')).offset().top - $('#search-tmp').offset().top);
		// $('#search-tmp').scrollTop($(here.attr('href')).offset().top - here.offset().top - 10);
		$('body').scrollTop($(here.attr('href')).offset().top);
	});


	$('.analyzeMe').live('click', function() {
		$('#template-download-selected').removeClass('template-download-selected');		// remove the old selected style
		$('#template-download-selected').removeAttr('id');								// remove the old selected style
		$('#info-panel-close').trigger('click');

		var me = $(this);
		$('.navbar').addClass('navbar-shadow');									// adding shadow to the nav bar once analyze pane is open
		$('.footer-copyright').addClass('footer-shadow');
		var sysname = "<span class='node-title'> &middot " + me.parents('.ts-info-action').prev().find('.ts-info-right').find('span:first').text().split(':')[1] + '</span>';
		var systype = "<span class='node-title'> &middot " + me.parents('.ts-info-action').prev().find('.ts-info-right').find('span:nth-child(3)').text().split(':')[1] + '</span>';
		var sysver  = "<span class='node-title'> &middot " + me.parents('.ts-info-action').prev().find('.ts-info-right').find('span:nth-child(5)').text().split(':')[1] + '</span>';

		$('#file-selected').html($(me.closest('.template-download')).children('.ts-info-top').html() + sysname + systype + sysver);
		var offset = 0 - ($('.file-container').height() - 85);
		$('.file-container').css('margin-top', offset);
		$('#file-container-close').html('<i class="ss-navigatedown"></i>');
		$('#file-container-close').attr('id', 'file-container-open');

		setTimeout(function() {
			if (!$('#load-div').length) {
				$('body').css('opacity', '0.2');

				$('.fileupload-loading').css('position', 'fixed');
				$('.fileupload-loading').css('z-index', '2');
				$('.fileupload-loading').css('top', '50%');
				$('.fileupload-loading').css('left', '50%');
				$('.fileupload-loading').css('width', '10em');
				$('.fileupload-loading').css('height', '10em');
				$('.fileupload-loading').css('margin-top', '-5em');
				$('.fileupload-loading').css('margin-left', '-5em');
				$('.fileupload-loading').css('border', '1px solid .ccc');
				$('.fileupload-loading').css('background-color', 'black');
				$('.fileupload-loading').css('opacity', '0.9');
				$('.fileupload-loading').css('display', 'block');

				$('#welcome-info').css('display', 'none');
				$('#file-detail').html('<iframe id="load-div" width="100%" height="100%" scrolling="no" style="border: 0;" onload="loadComplete(this)"></iframe><i id="load-div-close" class="ss-delete close"></i>');
				$('#file-detail').css('display', 'block');
				$('#load-div').attr('src', me.attr('href'));
			}
			else {

				$('body').css('opacity', '0.2');
				
				$('.fileupload-loading').css('position', 'fixed');
				$('.fileupload-loading').css('z-index', '2');
				$('.fileupload-loading').css('top', '50%');
				$('.fileupload-loading').css('left', '50%');
				$('.fileupload-loading').css('width', '10em');
				$('.fileupload-loading').css('height', '10em');
				$('.fileupload-loading').css('margin-top', '-5em');
				$('.fileupload-loading').css('margin-left', '-5em');
				$('.fileupload-loading').css('border', '1px solid #ccc');
				$('.fileupload-loading').css('background-color', 'black');
				$('.fileupload-loading').css('opacity', '0.9');
				$('.fileupload-loading').css('display', 'block');

				$('#load-div').attr('src', me.attr('href'));
			}

		}, 500);
		
		setTimeout(function() {
			$('#file-selected').css('display', 'block');
		}, 500);
		
	});

	$('#load-div-close').live('click', function() {
		$('.navbar').removeClass('navbar-shadow');
		$('.footer-copyright').removeClass('footer-shadow');
		$('#load-div-close').remove();
		$('#load-div').remove();
		$('#file-selected').css('display', 'none');
		$('#file-detail').css('display', 'none');
		$('#welcome-info').css('display', 'block');
		$('#template-download-selected').removeClass('template-download-selected');
		$('#template-download-selected').removeAttr('id');

		$('.file-container').css('margin-top', 0);
		$('#file-container-open').html('<i class="ss-navigateup"></i>');
		$('#file-container-open').attr('id', 'file-container-close');
		$('#info-panel-close').trigger('click');
	});

	$('#file-container-close').live('click', function() {
		var offset = 0 - ($('.file-container').height() - 85);
		$('.file-container').css('margin-top', offset);

		$('#file-container-close').html('<i class="ss-navigatedown"></i>');
		$('#file-container-close').attr('id', 'file-container-open');
	});
	$('#file-container-open').live('click', function() {
		$('.file-container').css('margin-top', 0);
		$('#file-container-open').html('<i class="ss-navigateup"></i>');
		$('#file-container-open').attr('id', 'file-container-close');
	});


	$('.ui-tabs-anchor').live('click', function() {
		var iframe = $(parent.document.getElementById('load-div'));
		container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;
		iframe.css('height', container_height + 'px');		
	});

	$('.accordion-toggle').live('click', function() {
		setTimeout(function() {
			var iframe = $(parent.document.getElementById('load-div'));
			container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;
			iframe.css('height', container_height + 'px');		
		}, 500);
	});

	$('.testThis').live('click', function() {
		var content 		= $(this).attr("data-content");
		var infoPanel 		= $(parent.document.getElementById('info-panel'));
		var infoPanelClose 	= $(parent.document.getElementById('info-panel-close'));
		var infoPre 		= $(parent.document.getElementById('info-pre'));
		var fileDetail 		= $(parent.document.getElementById('file-detail'));
		infoPre.html(content);
		infoPanel.css('display', 'block');
		fileDetail.animate({width: '60%'}, 300);
		infoPanel.animate({width: '39%'}, 300);
		infoPanelClose.css('display', 'block');
	});
	$('#info-panel-close').live('click', function() {
		var infoPanel 	= $('#info-panel');
		var fileDetail 	= $('#file-detail');	
		infoPanel.animate({width: '0'}, 300);
		fileDetail.animate({width: '100%'}, 300, function() {
			infoPanel.css('display', 'none');
		});
	});
	$('.config-title, .show-title, .search-title').live('click', function() {
		var iframe = $(parent.document.getElementById('load-div'));
		if(iframe) {
			container_height = iframe.context.contentWindow.document.body.children[0].clientHeight;
			iframe.css('height', container_height + 'px');	
			// window.parent.$('body').animate({scrollTop: 0}, 300 );
			var to = window.parent.$('#file-selected').offset().top;
            var height = window.parent.$('#file-selected').outerHeight();
            window.parent.$('body').animate({scrollTop: to - height}, 300 );
		}
	});
});

function loadComplete(iframe) {
	$('body').css('opacity', '1');
	$('.fileupload-loading').css('display', 'none');
	// console.log(iframe.contentWindow)
	// console.log(iframe.contentWindow.document.body.scrollHeight)
	container_height = iframe.contentWindow.document.body.scrollHeight;

	iframe.height = container_height + 'px';
		
}
