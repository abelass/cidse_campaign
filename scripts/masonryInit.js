/**
 * Infinite Scroll + Masonry + ImagesLoaded
 */

$(function(){
    
    var $container = $('#grid');
    
    $container.imagesLoaded(function(){
      $container.masonry({
    	  // set itemSelector so .grid-sizer is not used in layout
		  itemSelector: '.grid-item',
		  // use element for option
		  columnWidth: '.grid-item',
		  percentPosition: true
      });
    });
    
    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation 
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.grid-item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
        $('li.active').removeClass('active').next('li').addClass('active');
      }
    );

  });