<div id="cancelado">
<div data-role="collapsible" data-content-theme="c">
    <h3><?php echo LANG_ordersCancel ?></h3>

    <form id="form2" data-transition="slide"  method="post"> 

        <div data-role="fieldcontain">


            <div>

                <div id="cancelar">
                    <label style="font-weight:bold" for="motivo"><?php echo LANG_ordersCancelInfo ?></label>
                    <textarea data-mini="true" id="motivo" name="motivo"></textarea> 
                    <input type="hidden" name="id" id="id" value="<?php echo $cabecera["id"] ?>" />
                </div>

                <button data-role="submit" data-theme="a" id="cancel" name="cancel" value="submit-value" data-inline="true"><?php echo LANG_ordersCancel ?></button>

            </div>

        </div>  

    </form> 


</div>
</div>