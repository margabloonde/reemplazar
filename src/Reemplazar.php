<?php
namespace Marga\Reemplazar;

class Reemplazar
{
    public static function buscarReemplazar($forigen, $fdestino)
    //public function buscarReemplazar()
    {
        try {
            /* Rutas de los ficheros a utilizar*/
            //$fichero_origen = "C:/Users/Bloo/xampp/htdocs/herramientas2/app/f_origen/en.json";
            //$fichero_destino = "C:/Users/Bloo/xampp/htdocs/herramientas2/app/f_destino/en.json";

            $fichero_origen = $forigen;
            $fichero_destino = $fdestino;

            /* Leer Fichero y Descodificar el JSON*/
            $f_origen = file_get_contents($fichero_origen);
            $datos_origen = json_decode($f_origen, true);
            $f_destino = file_get_contents($fichero_destino);
            $datos_destino = json_decode($f_destino, true);

            /* Recorrer el fichero destino, buscando la clave del fichero origen, para reemplazar el valor destino */
            foreach ($datos_origen as $clave_origen => $valor_origen) {
                foreach ($datos_destino as $clave_destino => $valor_destino) {
                    if ($clave_origen == $clave_destino) {
                        $datos_destino[$clave_origen] = $valor_origen;
                    }
                }
            }
            /* Codificar el formato a JSON*/
            $resultado_destino = str_replace('\/', '/', json_encode($datos_destino, JSON_UNESCAPED_UNICODE));
            /* Guardar el JSON en el fichero */
            $fichero = fopen($fichero_destino, "w");
            fwrite($fichero, $resultado_destino);
            fclose($fichero);

            return response('El fichero ha sido reemplazado con éxito');

        } catch (\Exception $e) {
            return response('Se produjo el siguiente ERROR:  '.$e->getMessage());
        }
        //return 'Este es un mensaje para la funcion buscar y Reemplazar';
    }

}