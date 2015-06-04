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
	
	
		var load_posts = function(parm){
            $.ajax({
                type       : "GET",
                data       : {action: 'cwp_loop',numPosts : parm, pageNumber: page, catNumber: catid, yearPar: yearvar, monthPar: monthvar, authorPar: authorvar, tagPar: tagvar},
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
					$("#temp_load").remove();
                    $data = $(data);
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
		
	
		var cwp_megar_default_posts_per_page = $("#cwp_megar_default_posts_per_page").val();
		if(typeof cwp_megar_default_posts_per_page == 'undefined') {
			cwp_megar_default_posts_per_page = 10;
		}
		
    	$(window).scroll(function(){
          
        	var content_offset = $content.offset(); 
            
            	if((load == true) && ((page * 4) < cwp_megar_default_posts_per_page)) {
                	load_posts(4);
					page++;
				}
				else if((load == true) && (((page * 4) - cwp_megar_default_posts_per_page) < 4)) {
					load_posts(((page * 4) - cwp_megar_default_posts_per_page));
					page++;
				}
				
    	});
  
	load_posts(4);
	page++;
});