$(document).ready(function(){

	$( window ).resize(function() {
		if(typeof resizeInterval === 'undefined')
  			resizeInterval = setInterval(function()
  			{
  				if($.pagewalkthrough('isPageWalkthroughActive'))
  				{
  					$.pagewalkthrough('restart');
  				}
  				clearInterval(resizeInterval);
  				resizeInterval = undefined;
  			}, 500)
	});

	$('#wt').on('click', function(){
		$.pagewalkthrough('show', 'walkthrough');
	});

	$('.tooltip_prev').live('click', function(e){
		$.pagewalkthrough('prev',e);
	});

	$('.tooltip_next').live('click', function(e){
		$.pagewalkthrough('next',e);
	});

	$('.see_details').live('click', function(e){
		$(".see_detail_btn").trigger( "click" );
		var myInterval = setInterval(function(){$.pagewalkthrough('next',e); clearInterval(myInterval);}, 100)
	});

	$('.restart-step').live('click', function(e){
		$.pagewalkthrough('restart',e);
	});	

	$('.tooltip_close').live('click', function(){
		$.pagewalkthrough('close');
	});

	$('#walkthrough').pagewalkthrough({

		steps:
		[
			{
				wrapper: '',
				margin: '0',
				popup:
				{
					content: '#wt-step-0',
					type: 'modal',
					position: '',
					offsetHorizontal: 0,
					offsetVertical: 0,
					width: '330'
				}
			},

			{
				wrapper: '#wt-target-1',
				margin: '0',
				popup:
				{
					content: '#wt-step-1',
					type: 'tooltip',
					position: 'bottom',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '330'
				}
			},

			{
				wrapper: '#domain-section-2',
				margin: '0',
				popup:
				{
					content: '#wt-step-2',
					type: 'tooltip',
					position: 'top',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '#check_row_91',
				margin: '0',
				popup:
				{
					content: '#wt-step-3',
					type: 'tooltip',
					position: 'bottom',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '.wt-helper-fix',
				margin: '0',
				popup:
				{
					content: '#wt-step-4',
					type: 'tooltip',
					position: 'bottom',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '#dashboard-graph-header-inner',
				margin: '0',
				popup:
				{
					content: '#wt-step-5',
					type: 'tooltip',
					position: 'bottom',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '.graph-page-list-items',
				margin: '0',
				popup:
				{
					content: '#wt-step-6',
					type: 'tooltip',
					position: 'bottom',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '#date-selector',
				margin: '0',
				popup:
				{
					content: '#wt-step-7',
					type: 'tooltip',
					position: 'bottom',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '#graph-area',
				margin: '0',
				popup:
				{
					content: '#wt-step-8',
					type: 'tooltip',
					position: 'top',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},

			{
				wrapper: '#notification-email-content-inner',
				margin: '0',
				popup:
				{
					content: '#wt-step-9',
					type: 'tooltip',
					position: 'top',
					offsetHorizontal: 0,
					offsetVertical: 0,
					//width: '500'
				}
			},
		],
		name: 'Walkthrough',
		onLoad: true,
		onCookieLoad: function(){
			$.pagewalkthrough('show', 'walkthrough');
			//return true;
		}
	});
});