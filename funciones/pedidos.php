<?php 

    $consultaProductos = $baseDeDatos ->prepare("SELECT A.id, A.descripcio, M.descripcion medida, C.descripcion categoria  FROM articulos A 
    INNER JOIN medidas M on A.medida = M.id INNER JOIN categorias C on A.categoria = C.id ORDER BY descripcion ASC");
    try {
        $consultaProductos->execute();
    } catch (\Throwable $th) {
        $alertErrorConexion= "show";
      //  return $alertErrorConexion;
    }
    $productos = $consultaProductos -> fetchAll(PDO::FETCH_ASSOC);
    //return $productos;
