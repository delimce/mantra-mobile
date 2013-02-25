<?php session_start();
////seguridad
$profile = "admin,vendor,dispatch";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>


<script type="text/javascript">

    ////accion jquery
     $("div[data-role*='page']").live('pageshow', function() {  

        ////para eliminar pedidos en masa
        $("#categoriap").live("change", function () {
            listaproductos($("#categoriap").val());


        });

        $("#borrarp").click(function () {

            var n = $("input:checked").length;
            if(n>0){

                var answer = confirm("<?php echo LANG_ordersConfirmDeleteOrders ?>");
                if (answer){ ///llamada para eliminar los productos


                    var formData = $("#form2").serialize();
                    $.ajax({
                        type:"POST",
                        url:"controller/deleteOrderBatch.php",
                        data:formData,
                        success:function (data) {

                            $("#listaorder").html(data);

                            $("#totalreg").html('<?php echo LANG_totalReg  ?> ' + $("#listaorder > li").size());

                        },

                        complete:function () {

                            $("ul").listview('refresh');

                        }

                    })



                }

            }else{
                alert("<?=LANG_ordersNoSelectedOrders ?>")
            }

        })


    });

</script>

    <?php $tituloCurrent = LANG_ordersList; ?>    
<!--div de pagina-->
<div data-role="page" id="OrderList" xmlns="http://www.w3.org/1999/html">
		<div data-role="header">
                        <a href="../lobi.php" data-icon="back"><?php echo LANG_back ?></a>
			            <h1><?php echo $tituloCurrent ?> </h1>
            <?php if($tool->getNreg()>0 and $_SESSION['PROFILE']=="admin"){ ?>
            <a id="borrarp" data-theme="b"  data-icon="delete"><?php echo LANG_deleteit ?></a>
            <?php } ?>
                                               
		</div>
		<div data-role="content">

                        <p id="totalreg"><?php echo LANG_totalReg . $tool->getNreg(); ?></p>



            <form id="form2" data-transition="slide"  method="post">


            <ul id="listaorder"  data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li>
                                        <?php if($_SESSION['PROFILE']=="admin"){ ?>
                                        <input type="checkbox" id="check_<?php echo $row["id"] ?>" name="check_<?php echo $row["id"] ?>" value="<?php echo $row["id"] ?>" />
                                         <?php } ?>

                                        <a style="font-size: 15px;" data-ajax="false" href="orderDetails.php?id=<?php echo $row["id"] ?>">
                                        <div><b><?php echo LANG_ordersNumber ?></b> <?php echo $row["pcodigo"] ?></b></div>
                                        <div><b><?php echo LANG_ordersDate ?> </b><?php echo $row["fecha"] ?> <b>  <?php echo LANG_ordersClient ?> </b> <?php echo $row["cnombre"] ?> </div>
                                        <div><b> <?php echo LANG_ordersTotal.' '.$moneda ?> </b> <?php echo $row["total"] ?></div>
                                        <div><b><?php echo LANG_ordersStatus ?> </b><?php switch ($row["estatus"]) { case 1: echo LANG_ordersStatus1; break; case 2: echo LANG_ordersStatus2; break; case 10: echo LANG_ordersStatus10;  break; } ?></div>

                                       </a>
                                </li>
                                
                              <?php } ?>  
                        </ul>
                                    
           </form>

		</div>
		             
	</div>
   
 
</body>
</html>
<?php $tool->cerrar(); ?>