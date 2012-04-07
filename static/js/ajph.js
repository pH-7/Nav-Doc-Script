$(document).ready(function() {
 if (window.history && history.pushState) {
  historyedited = false;
  $(window).bind('popstate', function(e) {
   if (historyedited) {
    loadPage(location.pathname + location.search);
   }
  });
  doPager();
 }
});

function doPager() {
 $('article a, footer a, a#logo').click(function(e) {
  e.preventDefault();
  $('#ajph').html("<div id='loading'>Loading...</div>");
  loadPage($(this).attr('href'));
  history.pushState(null, null, $(this).attr('href'));
  historyedited = true;
 });
}

function loadPage(link) {
        $.ajax({
            url: link,
            processData: true,
            dataType:'html',
            success: function(data) {
                var content = $(data).find("#sub_ajph");
                var title = $(data).filter('title').text();
                document.title = title;

                $('#ajph').fadeOut('200',function(){
                    $(this).html(content.html()).fadeIn('200');
                });
            }
         });
              doPager();
}