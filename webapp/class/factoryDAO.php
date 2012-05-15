<?php

/**
 *clase que hace el llamado a todos los querys procedures y funciones a utilizar en la aplicacion 
 */

class factoryDAO extends  database {
    
    private $table;
    private $cuentaID;
    private $sql;
    
    /********************************************** CONSTRUCTOR */

  function __construct ($conect=''){ ///constructor de la clase

     if(!empty($conect)){

      		/////conexion de dos vistas
            if($conect=="db") $this->autoconexion();

     }

     
     ////para el uso de las tablas maestras y otros querys
     $this->cuentaID = $_SESSION['CUENTAID'];

  }
    
  
    /*
     * gete y setter de la tabla
     */
  
  
        public function setTable($tabla){

            $this->table = $tabla;
        }
        
        
        public function getTable(){

            return $this->table;
        }

        
        ////ejecuta un query
        
        public function commit(){
            
            $this->query($this->sql);
        }
        
    
        /*
         * trae  los datos de un usuario logueado ****LOGIN
         */

        public function getDataLogin($usuario,$clave){
        
//        return "(SELECT
//                        a.id,
//                        a.nombre,
//                        a.user,
//                        c.nombre as cnombre,
//                        c.site_titulo,
//                        c.banner_titulo,
//                        c.footer_titulo,
//                        c.moneda1,
//                        c.id as cid,
//                        'admin' as profile
//                        FROM
//                        tbl_admin AS a
//                        INNER JOIN tbl_cuenta_admin AS ca ON a.id = ca.admin_id
//                        INNER JOIN tbl_cuenta AS c ON ca.cuenta_id = c.id
//                        where a.user='$usuario' and a.pass = md5('$clave') and c.activo=1
//                        )
//                        UNION
//                        (SELECT
//                        v.id,
//                        v.nombre,
//                        v.user,
//                        c.nombre as cnombre,
//                        c.site_titulo,
//                        c.banner_titulo,
//                        c.footer_titulo,
//                        c.moneda1,
//                        c.id as cid,
//                        'vendor' as profile
//                        FROM
//                        tbl_vendedor AS v
//                        INNER JOIN tbl_cuenta AS c ON v.cuenta_id = c.id
//                        where v.user='$usuario' and v.pass = md5('$clave') and c.activo=1 and v.activo = 1 AND v.borrado = 0
//                        )UNION
//                        (SELECT
//                        d.id,
//                        d.nombre,
//                        d.user,
//                        c.nombre as cnombre,
//                        c.site_titulo,
//                        c.banner_titulo,
//                        c.footer_titulo,
//                        c.moneda1,
//                        c.id as cid,
//                        'dispatch' as profile
//                        FROM
//                        tbl_despachador AS d
//                        INNER JOIN tbl_cuenta AS c ON d.cuenta_id = c.id
//                        where d.user='$usuario' and d.pass = md5('$clave') and c.activo=1 and d.activo = 1 AND d.borrado = 0
//                        )";

        return "call sp_login('$usuario','$clave')";
                      
    }


    /*
     * registra el fin de sesion de un usuario ****LOGOUT
     */
    
    public function setFinSesion($id){
        
        $this->sql = "update tbl_acceso set sesion = 'Finalizada' where id = $id and cuenta_id = $this->cuentaID ";
        $this->commit();
        
    }
    
    
    
     /*
     * trae  toda la data de la tabla del admin por su clave primaria ****MISDATOS
     */
    
     public function getAllDataAdminByPk($id){
        
        $this->sql =  "SELECT *
                        FROM
                        tbl_admin a
                        INNER JOIN tbl_cuenta_admin c ON (a.id = c.admin_id)
                        where c.admin_id = $id and c.cuenta_id = $this->cuentaID " ;
         
        $tools = new tools();
        $tools->dbc = $this->dbc;
        
        $data = $tools->simple_db($this->sql);
        
        return $data;
        
    }
    
    
    
    /*
     * trae el password de un usuario por su id ****MISDATOS
     */
    
     public function getDataPassword($tabla,$id){
        
        return "select pass from $tabla where id = $id ";
        
        
    }
    
    
    /*
     * trae historico de las cantidades añadidas por cada producto segun la cuenta al inventario ***STOCK
     */
    
    public function getInventario(){
        
//        $this->sql = "SELECT 
//                        p.id,
//                        p.descripcion,
//                        SUM(CASE WHEN i.operacion = 'sum' THEN i.cantidad ELSE 0 END) - SUM(CASE WHEN i.operacion = 'res' THEN i.cantidad ELSE 0 END) AS cantidad
//                        FROM
//                        tbl_producto p
//                        LEFT OUTER JOIN tbl_inventario i ON (p.id = i.producto_id)
//                        AND (p.cuenta_id = i.cuenta_id)
//                        where p.cuenta_id = $this->cuentaID and p.borrado = 0
//                        GROUP BY p.id ";
        
        $this->sql = "call sp_traer_inventario($this->cuentaID)";
        
        $this->commit();
        
        
    }

    
    /*
     * trae los datos del nombre de producto y la unidad (presentacion usada) ***STOCK
     */

    public function getProdUnit($idProd,$idcuenta){
        
        return "SELECT 
                    p.descripcion,
                    u.titulo as unidad
                    FROM
                    tbl_producto p
                    INNER JOIN tbl_unidad u ON (p.unidad_med = u.id)
                    AND (p.cuenta_id = u.cuenta_id)
                    WHERE
                    p.id = $idProd AND 
                    p.cuenta_id = $idcuenta ";
    }
    
    
    /*
     * trae las cantidades y el historial del inventario del producto ****STOCK
     */
    
    
    public function getCant($idProd,$idcuenta){
        
        return "SELECT 
                    date(i.fecha) as fecha,
                    i.accion,
                    i.operacion,
                    i.cantidad,
                    i.ref_pedido
                    FROM
                    tbl_inventario i
                    where i.cuenta_id = $idcuenta and i.producto_id = $idProd 
                    order by fecha ";
    }
    
    
    ///////el html del combo con la lista de productos segun la categoria ****ORDER
    
    public function getComboProdByCatId($catid){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         ////trayendo montos que afecten la lista de precios
         
         $clienteId = empty($_SESSION['PEDIDO_CLIENTEID']) ? 0 : $_SESSION['PEDIDO_CLIENTEID'];    
//         $monto = $tools2->simple_db("select monto from tbl_cliente where id = $clienteId and cuenta_id = $this->cuentaID ");
//         
//         //////
//         
//         
//         $query = "SELECT 
//                        p.id,
//                        concat(p.descripcion,', ',u.titulo,' precio venta: ',format(fc_porcentaje(p.precio1,$monto),2),' PVS: ',format(precio3,2)) as descripcion
//                        FROM
//                        tbl_producto p
//                        LEFT OUTER JOIN tbl_unidad u ON (p.unidad_med = u.id)
//                        AND (p.cuenta_id = u.cuenta_id)
//                        INNER JOIN tbl_producto_categoria c ON (p.id = c.producto_id)
//                        AND (p.cuenta_id = c.cuenta_id)
//                        WHERE
//                        c.categoria_id = $catid and p.cuenta_id = $this->cuentaID and p.activo = 1 and p.borrado = 0
//                    order by p.descripcion";
         
        
        $query = "call sp_traer_prod_venta($catid,$this->cuentaID,$clienteId)"; 
         
        return $tools2->combo_db("producto", $query, "descripcion", "id",false,false,false,LANG_NoProdForCat);
        
    }
    
    
    /////////////////////////////campos de la lista de productos para order ****ORDER
    
    public function getProdDataStock($id){
        
    
                 
        $tools = new tools();
        
        $tools->dbc = $this->dbc;
        
         /////////alteracion de los precios
                
         $clienteId = empty($_SESSION['PEDIDO_CLIENTEID']) ? 0 : $_SESSION['PEDIDO_CLIENTEID'];    
//         $monto = $tools->simple_db("select monto from tbl_cliente where id = $clienteId and cuenta_id = $this->cuentaID ");
//         
//         //////
//        
//         $this->sql = "select descripcion,fc_porcentaje(precio1,$monto) as precio1 from tbl_producto where id = $id and cuenta_id = $this->cuentaID and activo = 1 and borrado = 0 ";
//       
         $this->sql ="call sp_traer_prod_data_orden($clienteId,$id,$this->cuentaID)";
        
        $data = $tools->simple_db($this->sql);
         
         return $data;
        
    }
    
    
    ////////////////////trae l info de los productos del pedido ****ORDER
    
    public function getOrderTempData($productos){
        
        
         $tools = new tools();
        
        $tools->dbc = $this->dbc;
        
         /////////alteracion de los precios
                
         $clienteId = empty($_SESSION['PEDIDO_CLIENTEID']) ? 0 : $_SESSION['PEDIDO_CLIENTEID'];    
         $monto = $tools->simple_db("select monto,tipo_cargo from tbl_cliente where id = $clienteId and cuenta_id = $this->cuentaID ");
         
         //////
        
        
        
        $prods = implode(",",$productos);
        
        $this->sql = "SELECT 
                        p.id,
                        p.descripcion,
                        fc_porcentaje(p.precio1,{$monto['monto']},'{$monto['tipo_cargo']}') as precio1,
                        p.paga_impuesto as civa
                        FROM
                        tbl_producto p
                        WHERE
                        p.id  in ($prods) and p.activo = 1 and p.borrado = 0 and p.cuenta_id = $this->cuentaID
                        order by p.descripcion";
        
        $this->commit();
    }
    
    
    /////////////traer los productos donde aplica el iva cuando se genera el pedido ****ORDER
    public function getProdsIva($prods,$idcuenta){
        
               
         $ids = implode(",",$prods);
         return "SELECT p.id
                        FROM
                        tbl_producto p
                        WHERE
                        p.cuenta_id = $idcuenta and p.id in ($ids)  and paga_impuesto = 1";
         
        
        
    }
    
    ////function que cancela el pedido *****ORDER
    
    public function cancelOrder($id,$motivo){
        
        $this->abrir_transaccion();
        
        $this->sql = "update tbl_pedido set estatus = 10, fecha_anulado = NOW(), motivo_anulado = '$motivo'  where id = $id and cuenta_id = $this->cuentaID ";
        $this->commit();
        
        $this->sql = "delete from tbl_inventario where ref_pedido = $id and cuenta_id = $this->cuentaID";
        $this->commit();
        
        
        $this->cerrar_transaccion();
    }
    
    
    ////function que processa el pedido *****ORDER
    ////necesita el id del pedido y el id del despachador
    public function processOrder($id,$despachador){
        
        $this->sql = "update tbl_pedido set estatus = 2, fecha_despacho = NOW(), despachador_id = $despachador  where id = $id and cuenta_id = $this->cuentaID "; 
        $this->commit();
    }


    
    
    
    /////////////traerme el valor del Impuesto Iva
    public function getIva($idcuenta){
        
        return "select imp_iva from tbl_cuenta where id = $idcuenta";
    }
    
    
    ////traer datos de preferencia para pedidos *****ORDERS
    
     public function getdataOrderPref(){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         $query = "SELECT 
                        c.moneda1,
                        c.imp_iva as iva
                        FROM
                        tbl_cuenta c
                        WHERE
                        c.id = $this->cuentaID ";
         
        return $tools2->simple_db($query);
        
    }
    
    
    
     //////////traer los datos de lista de pedidos ***ORDERS 
    public function getAllDataOrder($idVendor=false){
        

         $this->sql = "SELECT 
                        p.id,
                        p.estatus,
                        c.nombre as cnombre,
                        c.codigo as ccodigo,
                        format(p.total,2) as total,
                        date_format(p.fecha_creado,'%d/%m/%Y') as fecha
                        FROM
                        tbl_pedido p
                        INNER JOIN tbl_cliente c ON (p.cuenta_id = c.cuenta_id)
                        AND (p.cliente_id = c.id)
                        WHERE
                        p.cuenta_id = $this->cuentaID and p.borrado = 0 ";
         
         ////en el caso del vendedor
         if($idVendor) $this->sql.= " and p.vendedor_id = ".$idVendor;
         
        
         ////ordenar
         $this->sql.= " order by p.estatus,fecha desc,cnombre";
         
         $this->commit();
        
        
    }
    
    
    
    //////trae la data de todos los pedidos para el despachador ***ORDERS 
    
    ///el despachador puede ver los pedidos estatus "nuevo" y los "procesados" si son del dia actual, al siguiente dia no salen los procesados.
    public function getDataOrderDispath(){
        
        $this->sql = "call sp_traer_pedidos_despachador($this->cuentaID); ";
        
        $this->commit();
    }
    
    
    //////traer moneda
    
    public function getMoneda(){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         
         $query = "select moneda1 from tbl_cuenta where id = $this->cuentaID";
         
         return $tools2->simple_db($query);
        
    }
    
    
    //////////traer los datos encabezados del pedido ***ORDERS
    public function getDataOrder($id){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
        
         $query = "call sp_traer_pedido($id,$this->cuentaID)";
         
        return $tools2->simple_db($query);
        
        
    }

    public function  getDataOrderDetail($id){
        
        
        $this->sql = "call sp_traer_pedido_detalle($id,$this->cuentaID)";
        
        $this->commit();
    }










    public function getNameProd($idProd){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         $query = "SELECT 
                        p.descripcion
                        FROM
                        tbl_producto p
                        WHERE
                        p.id = $idProd and p.cuenta_id = $this->cuentaID ";
         
        return $tools2->simple_db($query);
        
    }
    
    
     public function getNameClient($idCli){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         $query = "SELECT 
                        c.nombre
                        FROM
                        tbl_cliente c
                        WHERE
                        c.id = $idCli and c.cuenta_id = $this->cuentaID ";
         
        return $tools2->simple_db($query);
        
    }
    
     public function getNameVendor($idVen){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         $query = "SELECT 
                        v.nombre
                        FROM
                        tbl_vendedor v
                        WHERE
                        v.id = $idVen and v.cuenta_id = $this->cuentaID ";
         
        return $tools2->simple_db($query);
        
    }
    
    
    
    
    
    
     ////trae el query para generar un combo de categoria de producto ****PRODCATEGORIA
    
    public function getComboCatProd($cuenta){
        
      return "select nombre,id from tbl_prodcategoria where cuenta_id = $cuenta and activo = 1 and borrado = 0 order by nombre";  
        
    }
    
     ////trae toda la data de las categorias de productos ****PRODCATEGORIA
    
    
     public function getDataProdCat(){
        
        $this->sql = "call sp_traer_categoria_productos($this->cuentaID); ";
        
        $this->commit();
         
    }
    
    /////trae todos los productos en existencia ****MASTER PRODUCT
    
     public function getAllDataProd($orderby){
        
             
        $this->sql = "SELECT 
                            p.id,
                            p.codigo,
                            p.descripcion,
                            p.unidad_med,
                            p.unidad_cant,
                            p.precio1,
                            p.precio3,
                            p.activo,
                            ifnull(u.titulo,'<b>N/A</b>') AS presentacion
                            FROM
                            tbl_producto p
                            LEFT OUTER JOIN tbl_unidad u ON (p.unidad_med = u.id)
                            AND (p.cuenta_id = u.cuenta_id)
                            WHERE
                            p.borrado = 0 AND 
                            p.cuenta_id = $this->cuentaID
                            ORDER BY
                            $orderby ";
        
        $this->commit();
        
        
    }
    
    
    ////trae toda la data de las categorias de clientes ****CLIENTECATEGORIA
    
    public function getDataClientCat(){
        
        $this->sql = "call sp_traer_categoria_clientes($this->cuentaID)";
        
        $this->commit();
        
        
    }

    
    /*
     * cargar vendedores para maestro de clientes *****MASTER CLIENT
     */
    
    public function comboVendors($cuenta){
        
        return "select nombre,id from tbl_vendedor where cuenta_id = $cuenta and activo = 1 and borrado = 0";
    }


     /*
     * cargar vendedores para maestro de clientes *****MASTER CLIENT
     */
    
    public function comboClientCat($cuenta){
        
        return "select nombre,id from tbl_clientcategoria where cuenta_id = $cuenta and borrado = 0 and activo = 1";
    }
    
    /*
     * para obtener el ide de la categoria *****MASTER CLIENT
     */
    public function getIdCatCli($cuenta){
        
       return "SELECT pc.categoria_id
                    FROM
                    tbl_cliente_categoria pc
                    WHERE
                    pc.cliente_id = '$id' AND 
                    pc.cuenta_id = $cuenta  "; 
        
    }
    
    
    
    /////////////////////monto de la categoria para calcualr el precio sugerido ***MASTER PRODUCT
    
    public function getMontocatProd($id,$cuenta){
        
        
        return "select monto from tbl_prodcategoria where id = $id and cuenta_id = $cuenta";
        
    }


    
    ///////////////combo que muestra la lista de cllientes por vendedor asignado ****STOCK
    
    public function getComboClientByVendor($cuenta,$vendor){
        
        return "select nombre,id from tbl_cliente where cuenta_id = $cuenta and activo = 1 and borrado = 0 and vendedor_id in (0,$vendor) order by nombre";
        
        
    }


    
    
    //////////trae toda la data de los vistantes por cuenta ****MONITOR
    
    public function getAllVistByAcount(){
        
        $idcuenta = $this->cuentaID;
        $this->sql = "call sp_accesos_totales($idcuenta);";
        $this->commit();
        
    }


    /////trae todos los accesos de la persona por userid, perfil y cuenta ****MONITOR
    public function getDataVisitor($userid,$perfil){
        
        $this->sql = "SELECT 
                        a.ipaddress as ip,
                        date_format(fc_fecha_real(a.fecha,$this->cuentaID),'%d/%m/%y %r') as fecha,
                        a.sesion
                        FROM
                        tbl_acceso a
                        WHERE
                        a.userid = $userid AND 
                        a.perfil = '$perfil' AND 
                        a.cuenta_id = $this->cuentaID
                        ORDER BY
                        a.fecha DESC";
        
        $this->commit();
        
    }
    
    
    
    /*
     * traer el numero de ventas y el total por vendedor
     */
    public function getOrderSales(){
        
        $this->sql = "call sp_traer_ventas($this->cuentaID);";
        
        $this->commit();
        
    }
    
    
     public function getNamebyProfile($id,$perfil){
        
         $tools2 = new tools();
         $tools2->dbc = $this->dbc;
         
          switch ($perfil) {
            case "vendor":
                    $this->setTable("tbl_vendedor");
                    $cuenta = "and cuenta_id = $this->cuentaID";
                break;
           case "dispatch":  
                    $this->setTable("tbl_despachador");
                    $cuenta = "and cuenta_id = $this->cuentaID";
                break;
            
             case "admin":  
                    $this->setTable("tbl_admin");
                 
                break;
        }
              
         $query = "SELECT 
                        nombre
                        FROM
                        $this->table 
                        WHERE
                        id = $id $cuenta";
         
        return $tools2->simple_db($query);
        
    }



    /*
     * añade un nuevo registro de maestro *****COMUN PARA MAESTROS
     */
    
    
    public function addData(){
        
         $tools = new formulario();
         $tools->dbc = $this->dbc;
        
         $tools->insert_data("r", "9", $this->table, $_POST);
         
         $this->setUltimoID($tools->getUltimoId());
        
    }
    
    

    /*
     * guarda la data de un maestro *****COMUN PARA MAESTROS
     */
    
    
    public function saveData($id){
        
         $tools = new formulario();
         $tools->dbc = $this->dbc;
        
         $tools->update_data("r", "9", $this->table, $_POST,"id = $id  and cuenta_id = $this->cuentaID ");
        
         
        
    }
    
    
    
    /*
     * guarda la data de un maestro solo por su ID sin la cuenta *****COMUN PARA MAESTROS
     */
    
    
    public function saveDataOnlyId($id){
        
         $tools = new formulario();
         $tools->dbc = $this->dbc;
        
         $tools->update_data("r", "9", $this->table, $_POST,"id = $id ");
        
         
        
    }


    /*
     * coloca como borrado un registro *****COMUN PARA MAESTROS
     */
    
    public function setBorrado($id){
        
        $this->sql = "update $this->table set borrado = 1, fecha_borrado = NOW() where id = $id and cuenta_id = $this->cuentaID ";
        $this->commit();
    }
    
    /*
     * purga los accesos del veneddor y despachador (por ahora) *****COMUN PARA MAESTROS
     */
    
    public function setPurgeAccess($id){
        
       
        switch ($this->table) {
            case "tbl_vendedor":
                $perfil = "vendor";
                break;
           case "tbl_despachador":
               $perfil = "dispatch";  
                break;
        } 
        
         $this->sql = "delete from tbl_acceso where userid = $id and perfil = '$perfil' and cuenta_id = $this->cuentaID ";
         $this->commit();
       
        
    }
    
    
    /*
     * borra un vendedor o despachador
     */
    
     public function setBorradoPurgado($id){
        
        $this->abrir_transaccion();
         
        $this->setBorrado($id);
        
        $this->setPurgeAccess($id);
       
        $this->cerrar_transaccion(); 
        
    }

    

    /*
     * trae toda la data no borrada de una tabla *****COMUN PARA MAESTROS
     * se le puede pasar el parametro de orden
     */
    
    public function getAllData($orderBy=false){
        
        $this->sql = "select * from $this->table where cuenta_id = $this->cuentaID and borrado = 0 ";
        if($orderBy) $this->sql.= "order by $orderBy";
        
        $this->commit();
        
    }
    
    
    /*
     * verifica si el codigo existe al insertar el registro *****COMUN PARA MAESTROS
     * si $id tiene valor valida el codigo en modo edicion EDITAR
     */
    
     public function isCodigoExist($codigo,$id=false){
         
         $this->sql = "select id from $this->table where codigo = '$codigo' and cuenta_id = $this->cuentaID ";
         if($id) $this->sql.=" and id != $id";
         
         $this->commit();
         
         if($this->getNreg()>0)
             return true;
             else
             return false;
         
     }






     /*
     * trae  toda la data de una tabla por su clave primaria *****COMUN PARA MAESTROS
     */
    
     public function getAllDataByPk($id){
        
        $this->sql = "select * from $this->table where id = $id and cuenta_id = $this->cuentaID ";
                
        $tools = new tools();
        $tools->dbc = $this->dbc;
        
        $data = $tools->simple_db($this->sql);
        
        return $data;
        
    }
    
    
    /*
     * trae  toda la data de una tabla por su clave primaria sin id de cuenta *****COMUN PARA MAESTROS
     */
    
     public function getAllDataByPkOnlyId($id){
        
        $this->sql = "select * from $this->table where id = $id ";
                
        $tools = new tools();
        $tools->dbc = $this->dbc;
        
        $data = $tools->simple_db($this->sql);
        
        return $data;
        
    }
    
    
    /*
     * setea el campo "activo" de la tabla segun el valor  activo que se le pase con el id del registro
     */
    
    public function setActivo($id,$activo=true){
        
        $active = ($activo==true ? 1 : 0);
        $this->sql = "update $this->table set activo = $active where id = $id and cuenta_id = $this->cuentaID ";
        $this->commit();
    }
    
    
    /*
     * borra fisicamente un registro segun el parametro campo que se le pase primaria
     */
    
     public function deleteData($id,$campo="id"){
        
        $this->sql = "delete from $this->table where $campo = $id and cuenta_id = $this->cuentaID ";
        $this->commit();
    }

};
?>
