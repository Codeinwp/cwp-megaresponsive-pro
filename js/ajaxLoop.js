jQuery(function($){
 
    var page = 1;
    var load = true;
    var loading = true;
    var $window = $(window);
    var $content = $(".list-posts");
	
	var catid = $("#catid").val();
	var yearvar = $("#year_id").val();
	var monthvar = $("#month_id").val();
	var authorvar = $("#author_id").val();
	var tagvar = $("#tag_id").val();
	
	
		var load_posts = function(){
            $.ajax({
                type       : "GET",
                data       : {action: 'cwp_loop',numPosts : 4, pageNumber: page, catNumber: catid, yearPar: yearvar, monthPar: monthvar, authorPar: authorvar, tagPar: tagvar},
                dataType   : "html",
                url        : ajaxurl,
                beforeSend : function(data,settings){
                    
					if ($("#temp_load").length === 0){
				
						$content.append('<div id="temp_load" style="text-align:center">\
                            <img src="' + $('#load_posts').val() + '/images/ajax-loader.gif" />\
                            </div>');
					}
  				
                },
                success    : function(data){
					page++;
					$("#temp_load").remove();
                    $data = $(data);
					//console.log($data);
                     if( $data.length != 0 ){ 
                        $content.append($data); 
                     }
                    else { 
                          load = false;
                    }
                },
                error     : function(jqXHR, textStatus, errorThrown) {
                    $("#temp_load").remove();
                    
                }
			});
		}
		
	
    

    $(window).scroll(function(){
          
            var content_offset = $content.offset(); 
//            loading = true;
            
            if((load == true)&&($(window).scrollTop() >= $(window).height() - 100)) {
                load_posts();
				page++;
			}
    })
  
load_posts();
});


    