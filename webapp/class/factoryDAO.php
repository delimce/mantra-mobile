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
        
        return "(SELECT
                        a.id,
                        a.nombre,
                        a.user,
                        c.nombre as cnombre,
                        c.site_titulo,
                        c.banner_titulo,
                        c.footer_titulo,
                        c.moneda1,
                        c.id as cid,
                        'admin' as profile
                        FROM
                        tbl_admin AS a
                        INNER JOIN tbl_cuenta_admin AS ca ON a.id = ca.admin_id
                        INNER JOIN tbl_cuenta AS c ON ca.cuenta_id = c.id
                        where a.user='$usuario' and a.pass = md5('$clave') and c.activo=1
                        )
                        UNION
                        (SELECT
                        v.id,
                        v.nombre,
                        v.user,
                        c.nombre as cnombre,
                        c.site_titulo,
                        c.banner_titulo,
                        c.footer_titulo,
                        c.moneda1,
                        c.id as cid,
                        'vendor' as profile
                        FROM
                        tbl_vendedor AS v
                        INNER JOIN tbl_cuenta AS c ON v.cuenta_id = c.id
                        where v.user='$usuario' and v.pass = md5('$clave') and c.activo=1 and v.activo = 1 AND v.borrado = 0
                        )";

        
               
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
        
        $this->sql = "SELECT 
                        p.id,
                        p.descripcion,
                        SUM(CASE WHEN i.operacion = 'sum' THEN i.cantidad ELSE 0 END) - SUM(CASE WHEN i.operacion = 'res' THEN i.cantidad ELSE 0 END) AS cantidad
                        FROM
                        tbl_producto p
                        LEFT OUTER JOIN tbl_inventario i ON (p.id = i.producto_id)
                        AND (p.cuenta_id = i.cuenta_id)
                        where p.cuenta_id = $this->cuentaID and p.borrado = 0
                        GROUP BY p.id ";
        
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
    
    
     ////trae toda la data de las categorias de productos ****PRODCATEGORIA
    
     public function getDataProdCat(){
        
        $this->sql = "SELECT
                        cat.id,
                        cat.nombre,
                        cat.descripcion,
                        count(PC.producto_id) as cant
                        FROM
                        tbl_prodcategoria AS cat
                        LEFT OUTER JOIN tbl_producto_categoria AS PC ON cat.id = PC.categoria_id AND cat.cuenta_id = PC.cuenta_id
                        WHERE
                        cat.borrado = 0 AND cat.cuenta_id = $this->cuentaID
                        GROUP BY
                        cat.id
                        ORDER BY
                        cat.nombre ASC ";
        
        $this->commit();
        
        
    }
    
    
    ////trae toda la data de las categorias de clientes ****CLIENTECATEGORIA
    
    public function getDataClientCat(){
        
        $this->sql = "SELECT 
                        cat.id,
                        cat.nombre,
                        cat.descripcion,
                        count(cliente_id) as cant
                        FROM
                        tbl_clientcategoria cat
                        LEFT OUTER JOIN tbl_cliente_categoria ON (cat.id = tbl_cliente_categoria.categoria_id)
                        AND (cat.cuenta_id = tbl_cliente_categoria.cuenta_id)
                        WHERE
                        cat.borrado = 0 and cat.cuenta_id = $this->cuentaID
                        GROUP BY
                        cat.id
                        ORDER BY
                        cat.nombre";
        
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
     * coloca como borrado un registro *****COMUN PARA MAESTROS
     */
    
    public function setBorrado($id){
        
        $this->sql = "update $this->table set borrado = 1, fecha_borrado = NOW() where id = $id and cuenta_id = $this->cuentaID ";
        $this->commit();
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
