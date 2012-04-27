<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>
<body>
    
    <script type="text/javascript">

    /***********************************************
    * Local Time script- © Dynamic Drive (http://www.dynamicdrive.com)
    * This notice MUST stay intact for legal use
    * Visit http://www.dynamicdrive.com/ for this script and 100s more.
    ***********************************************/

    var weekdaystxt=["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"]

    function showLocalTime(container, servermode, offsetMinutes, displayversion){
    if (!document.getElementById || !document.getElementById(container)) return
    this.container=document.getElementById(container)
    this.displayversion=displayversion
    var servertimestring=(servermode=="server-php")? '<? print date("F d, Y H:i:s", time())?>' : (servermode=="server-ssi")? '<!--#config timefmt="%B %d, %Y %H:%M:%S"--><!--#echo var="DATE_LOCAL" -->' : '<%= Now() %>'
    this.localtime=this.serverdate=new Date(servertimestring)
    this.localtime.setTime(this.serverdate.getTime()+offsetMinutes*60*1000) //add user offset to server time
    this.updateTime()
    this.updateContainer()
    }

    showLocalTime.prototype.updateTime=function(){
    var thisobj=this
    this.localtime.setSeconds(this.localtime.getSeconds()+1)
    setTimeout(function(){thisobj.updateTime()}, 1000) //update time every second
    }

    showLocalTime.prototype.updateContainer=function(){
    var thisobj=this
    if (this.displayversion=="long")
    this.container.innerHTML=this.localtime.toLocaleString()
    else{
    var hour=this.localtime.getHours()
    var minutes=this.localtime.getMinutes()
    var seconds=this.localtime.getSeconds()
    var ampm=(hour>=12)? "PM" : "AM"
    var dayofweek=weekdaystxt[this.localtime.getDay()]
    this.container.innerHTML=formatField(hour, 1)+":"+formatField(minutes)+":"+formatField(seconds)+" "+ampm
    }
    setTimeout(function(){thisobj.updateContainer()}, 1000) //update container every second
    }

    function formatField(num, isHour){
    if (typeof isHour!="undefined"){ //if this is the hour field
    var hour=(num>12)? num-12 : num
    return (hour==0)? 12 : hour
    }
    return (num<=9)? "0"+num : num//if this is minute or sec field
    }

    </script>
 
    
    <script>
        function onSuccess(data, status)
        {
            data = $.trim(data);
            
           $("#notification").text(data);
           $("#notification").css({color:"blue", fontWeight:"bold"});
           
           
           
        }
 
        $(document).ready(function() {
            
            
             $('#form1').validate({
                rules : {
                        r9nombre : {
                        required : true
                    },
                        r9moneda1 :  {
                        required : true
                    },
                      r9dif_hora :  {
                        required : true,
                        number: true
                    },
                        r9imp_iva :  {
                        required : true,
                        number: true
                    }
                     
                }
            });
            
            
            
            $("#submit").click(function(){
                
            
             if(!$("#form1").valid()) return false; 
            
                      
 
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "controller/save.php",
                    cache: false,
                    data: formData,
                    success: onSuccess
                });
 
                return false;
            });
        });
    </script>

<!--misDatos-->
<?php $tituloCurrent = LANG_setup; ?>
<div data-role="page" id="pref">

		<div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                   <div id="titulo2"><?php echo LANG_setupDesc ?></div>
                        
            <form id="form1" method="post">
            
             <div data-role="fieldcontain">
            <label style="font-weight:bold" for="r9nombre"><?php echo LANG_setupAcount ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre" value="<?php echo $datos["nombre"] ?>"  />
            
            <label style="font-weight:bold" for="r9banner_titulo"><?php echo LANG_setupBanner ?></label>
             <input type="text" id="r9banner_titulo" name="r9banner_titulo" value="<?php echo $datos["banner_titulo"] ?>" >
             
             <label style="font-weight:bold" for="r9footer_titulo"><?php echo LANG_setupFooter ?></label>
             <input type="text" data-mini="true" id="r9footer_titulo" name="r9footer_titulo" value="<?php echo $datos["footer_titulo"] ?>"  />

             <div>
            <label style="font-weight:bold"><?php echo LANG_setupServerDatetime ?></label>
            <span id="timecontainer"></span>
            
                        <?php echo @date("d/m/Y"); ?> 
			<script type="text/javascript">
                        	new showLocalTime("timecontainer", "server-php", 0, "short")
			</script>
             </div>
             <label style="font-weight:bold" for="r9dif_hora"><?php echo LANG_setupDifHour ?></label>
             <input type="text" data-mini="true" id="r9dif_hora" name="r9dif_hora" value="<?php echo $datos["dif_hora"] ?>"  />

             
              <label style="font-weight:bold" for="r9moneda1"><?php echo LANG_setupMoneda1 ?></label>
             <input type="text" data-mini="true" id="r9moneda1" name="r9moneda1" value="<?php echo $datos["moneda1"] ?>"  />
             
              <label style="font-weight:bold" for="r9imp_iva"><?php echo LANG_setupImpIva ?></label>
             <input type="number" data-mini="true" id="r9imp_iva" name="r9imp_iva" value="<?php echo $datos["imp_iva"] ?>"  />
        	
            <p id="notification"></p>  
             </div>
               
           <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
           </form>        
              
		</div>
</div>
<!--misDatos-->


    
</body>
</html>   
