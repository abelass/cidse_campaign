$( document ).ready(function() {
  // latest post initialization
  var container = 'div.latest_videos';
  $(container).on('getLatestPost', function() {
    $(this).append("<div class='loading-bar'><img src='../images/loading.gif' /><p>Loading Post</p></div>\n");
  
    $(container + ' div.loading-bar').hide().fadeIn(300, function() {
      setTimeout(getLatestPost, 300);
    });
  });
  
  $(container).trigger('getLatestPost');
});

//parameter
var PRM = {
  post_page : 0
};

function getLatestPost() {
  $.ajax({
    url : "/spip.php?page=latest_videos&p=" + PRM.post_page,
    cache : false,
    type : 'GET',
    success : function(data, status) {
      var obj = $.parseJSON(data);

      if (obj.cond === 1 && status === 'success') {
        PRM.post_page++;
        appendPostList(obj, container, 'getLatestPost');
      } else if (obj.cond === 0 && status === 'success') {
        if (PRM.post_page !== 0) {
          var msg = '';
          msg += "<div>Sorry, no more posts to be loaded.</div>\n";
          $('div.latest-post div.loading-bar').remove();
          // appendListingError('div.latest-post',msg,'app');
        } else {
          var msg = '';
          msg += "<p>No post to be shown. Why don't create a new one?</p>\n";
          appendGeneralError('div.latest-post', msg, 'html');
        }
      } else {
        appendAjaxError('div.latest-post', 'app');
      }
    }
  });
}

function appendPostList(data, placement, triggerAct) {

  $(placement + ' div.loading-bar').fadeOut(300, function() {
    // generate proper date and time
    var date_time = att.get_user_date_time(this.created_date_time, 1);
    
    htmld = data.post;

    $(placement).append(htmld);
    addLoadMore('post', placement, triggerAct);
  }).remove();
}

function addLoadMore(type,placement,triggerAct,order){
 if(typeof(triggerAct)==='undefined'){triggerAct = '';} 
 if(typeof(order)==='undefined'){order = 'app';} 
 
 $('div.com-load').remove();
 //append
 var htmld='';
 
 htmld+="<div class='com-load'>\n";
 htmld+="<div><a href=#>Load more</a></div>\n";
 htmld+="</div>\n";
 
 if(order=='app'){
  $(placement).append(htmld);    
 }
 
 else{
  $(placement).prepend(htmld);     
 }
  
$('div.com-load a').click(function(e){
  if(type!=='comment'){
   $('div.com-load').remove();
   $(placement).trigger(triggerAct);
  }
  else{
   get_post_comment();
  } 
  e.preventDefault();
 });

 // auto trigger in viewport
 $('div.com-load a').waypoint(
 
  function(dir){
   if(type!=='comment'){
    if(dir=='down'){
     $('div.com-load').remove();
     $(placement).trigger(triggerAct);
    }
   }
   else{
    get_post_comment();
   } 
  },

  {
   offset:'bottom-in-view'
  }
 );

}

