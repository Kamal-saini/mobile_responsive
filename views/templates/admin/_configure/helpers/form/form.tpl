{*
*  @author    Miguel Costa for emotionLoop
*  @copyright emotionLoop
*}

{extends file="helpers/form/form.tpl"}


{block name="label"}
    {if $input.type == 'topform'}
        <section id="responsive" class="panel widget{if $allow_push} allow_push{/if}">
        <div class="panel-heading">
		&nbsp <i class="icon-mobile"></i> &nbsp Mobile Friendly Test
		<span class="panel-heading-action">
			<a class="list-toolbar-btn responsivetoggle" href="#" onclick="toggleDashResponsive('responsive'); return false;" title="Configure">
				<i class="process-icon-configure"></i>
			</a>
			
			<a class="list-toolbar-btn" href="#" onclick="googleResponsive(); return false;" title="Refresh">
				<i class="process-icon-refresh"></i>
			</a>
		</span>
	</div>
            
<section id="dashresponsive_config" class="dash_config hide">
		<header style="margin-bottom: 10px;background: #00AFF0;padding: 10px; color: #fff;"><i class="icon-wrench"></i> Configuration</header>
               <form id="configuration_form" class="bootstrap defaultForm form-horizontal " action="" method="post" enctype="multipart/form-data" >
                       <span><b>API Key :</b></span><br>
                       <input type="text" name="googleapi" id="googleapi" value="{$input.googleapi}" style="margin-top: 10px;">

<input type="hidden" name="url" id="url" value="{$input.getmodule}">
<div class="panel-footer">
<span>How to Generate <p> API Key? <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"> Click Here</a></p> </span> 
<button type="button"  onclick="saveGoogleapi();" value="1" id="configuration_form" name="submit" class="btn btn-default custom_response" >
<i class="process-icon-save"></i>    Save   
			</button>           </form>  

                  
</section>

<section id="dash_traffic" class="loading">
			
                    <div class="mobileresponse_dashbord" > 
                      <div class='loading_imgs'><img src='../modules/responsive/img/load.gif'></div>                          
                    </div>
                <div class="col-md-12 custom_button">
                 <a class="btn btn-default custom_button" target="_blank" href="http://responsivedesignchecker.com/https://developers.google.com/speed/pagespeed/insights/?url={$input.site_url}">Click here for more info</a></div>
                 <br>
                  <br>

                  <p class='developer_web_c'></p>
		
                                      
  </section>

      
                 {literal}
                   <script type="text/javascript">
                    function googleResponsive(){                        
                         var url = '../modules/responsive/data.php';
                         var img = "<div class='loading_imgs'><img src='../modules/responsive/img/load.gif'></div>";
                         $('.mobileresponse_dashbord').html(img);
                         $('.developer_web_c').html("");
                         $.ajax({
                             url: url,
                             success: function (data) {
                                 var mobile_speed = $(data).filter(".mobileresponse_custom").html();     
                                 $(".mobileresponse_dashbord").html(mobile_speed);
                                 
                                 var mobile_speed = $(data).filter(".developer_web").html();     
                                 $(".developer_web_c").html(mobile_speed);
                               
                               
                               
                               

                             }
                         });


                     }



			function saveGoogleapi(){   

                     	 var urls=$('#url').val();
                         var url = urls+"&configure=responsive&tab_module=front_office_features&module_name=responsive";
			
                       	 var googleapi= $('#googleapi').val();
                       
                         $.ajax({
                             url: url,
  			     type: "POST",
		             data: "&googleapi=" + googleapi,
                             success: function (data) {
                                 
                                $(".responsivetoggle").click();
                              
                             }
                         });


                     }


	function toggleDashResponsive(widget) {
	var func_name = widget + '_toggleDashResponsive';
	if ($('#'+widget+' section.dash_config').hasClass('hide'))
	{
		$('#'+widget+' section').not('.dash_config').slideUp(500, function () {
			$('#'+widget+' section.dash_config').fadeIn(500).removeClass('hide');
			if (window[func_name] != undefined)
				window[func_name]();
		});
	}
	else
	{
		$('#'+widget+' section.dash_config').slideUp(500, function () {
			$('#'+widget+' section').not('.dash_config').slideDown(500).removeClass('hide');
			$('#'+widget+' section.dash_config').addClass('hide');
			if (window[func_name] != undefined)
				window[func_name]();
		});
	}
}
                     
                    window.onload =googleResponsive();
                     </script>
                 {/literal}
 </section>

       <style>
#dash_traffic .loading_imgs{
text-align:center;

}
        div#topform-label .icon-mobile {
            font-size: 15px !important;
        }
       .mobileresponse {
        background: #c11263;
        color: #fff;
        padding: 6px 11px;
        border-radius: 4px;
        height: 150px;
        width: 170px;
        border-radius: 50%;
           line-height: 1.8;
        text-align: center;
        float: none;
        font-size: 17px;
        margin: 17px auto;
        box-shadow: 4px 2px 4px #606060;
        padding-top: 13px;
        padding-left: 12px;
        font-size: 18px;
        }
        .custom_button{
        margin-left: 0% !important;
        }
        span.mobile_total {
    font-size: 28px;
}
p.developer_web_c {
    text-align: center;
}
.col-md-12.custom_button {
    text-align: center;
}

.custom_response{
    float: right;
    margin-top: -23%;
    margin-right: 6px;
}

.adminmodules .custom_response {
    float: right;
    margin-top: -4.5%;
    margin-right: 6px;
}




            </style>
    {/if}
{/block}
