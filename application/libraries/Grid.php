<?php

class Grid {
    private $arr_columnas = "";
    private $arr_datos = "";
    private $str_html = "";
    private $theme = "";
    private $idvalue = "";
    private $idpaginador;

    function __construct() {
    }

    public function set_configs_paginador($arr_columns,$idvalue,$theme,$total_datos, $valores_xpagina, $funcion = ""){
      $this->arr_columns = $arr_columns;
      $this->idvalue = $idvalue;
      $this->theme = $theme;
      $this->is_paginador = TRUE;

      $this->total_datos = $total_datos;
      $this->limit_values_paginador = $valores_xpagina;
      $this->funcion = $funcion;
    }// set_configs_paginador()

    public function set_data($arr_datos=array()){
      $this->arr_datos = $arr_datos;
    }// set_data()

    public function get_table() {
      $this->get_header();
      $this->get_body();
      if($this->is_paginador  && $this->total_datos>$this->limit_values_paginador ){
        $this->get_paginador();
      }
      return $this->str_html;
    }// get_table()


    public function get_header(){
      $this->str_html .= "<div class='table-responsive'>";
      $this->str_html .= "<table class='table table-hover table-bordered table-sm'>";

      $this->str_html .= "<thead class={$this->theme}>";
      $this->str_html .= "<tr>";

      foreach ($this->arr_columns as $item => $c) {
          $tipo = $c["type"];
          $label = $c["header"];
          $width = (isset($c["width"]))?$c["width"]:"auto";
          switch ($tipo) {
            case 'hidden':
              $this->str_html .= "<th id='".$item."' hidden>";
              $this->str_html .= "<center>".$label."</center>";
              $this->str_html .= "</th>";
            break;
            case 'text':
              $this->str_html .= "<th id='".$item."' style='width:{$width}' class='font-weight-bold'> ";
              $this->str_html .= "<center>".$label."</center>";
              $this->str_html .= "</th>";
            break;
            case 'text_class':
              $this->str_html .= "<th id='".$item."' style='width:{$width}' class='font-weight-bold'> ";
              $this->str_html .= "<center>".$label."</center>";
              $this->str_html .= "</th>";
            break;
            case 'datetime':
              $this->str_html .= "<th id='".$item."' style='width:{$width}' class='font-weight-bold'>";
              $this->str_html .= "<center>".$label."</center>";
              $this->str_html .= "</th>";
            break;
            case 'button':
              $this->str_html .= "<th id='" . $item . "' style='width:{$width}'>";
              $this->str_html .= $label;
              $this->str_html .= "</th>";
              break;
            case 'icono':
            break;
          }
      }

      $this->str_html .= "</tr>";
      $this->str_html .= "</thead>";
    }// get_header()

    public function get_body(){
      $this->str_html .= "<tbody>";
      // echo "<pre>"; print_r($this->arr_datos[0][$this->idvalue]); die();
      if(count($this->arr_datos) > 0 && $this->arr_datos[0][$this->idvalue]!=""){
        for ($i = 0; $i<count($this->arr_datos); $i++) {
            $this->str_html .= "<tr class='table-light'>";
            $cont_columnas = 0;
            // "<pre>"; print_r($this->arr_datos);die();
            foreach ($this->arr_columns as $item => $c) {
              $tipo = $c["type"];
              $label = $c["header"];
              switch ($tipo) {
                case 'hidden':
                  $this->str_html .= "<td id='".$item."' data='".$this->arr_datos[$i][$item]."' hidden>";
                  $this->str_html .= $this->arr_datos[$i][$item];
                  $this->str_html .= "</td>";
                break;
                case 'text':
                  $this->str_html .= "<td id='".$item."' data='".$this->arr_datos[$i][$item]."' >";
                  $this->str_html .= $this->arr_datos[$i][$item];
                  $this->str_html .= "</td>";
                break;
                case 'text_class':
                  $estatus_texto = $this->arr_datos[$i][$item];
                  if(trim($estatus_texto) == 'Pendiente'){
                    $class = "estatus_pendiente";
                  }
                  if(trim($estatus_texto) == 'Autorizado'){
                    $class = "estatus_autorizado";
                  }
                  if(trim($estatus_texto) == 'Resuelto'){
                    $class = "estatus_resuelto";
                  }



                  $this->str_html .= "<td id='".$item."' data='".$this->arr_datos[$i][$item]."' >";
                  $this->str_html .= "<span class='".$class."'>".$this->arr_datos[$i][$item]."</span>";
                  $this->str_html .= "</td>";
                break;
                case 'datetime':
                  $datetime = $this->arr_datos[$i][$item];
                  $datetime_format = Utilerias::get_fecha_datetimepicker($datetime);
                  $this->str_html .= "<td id='".$item."' data='".$this->arr_datos[$i][$item]."' >";
                  $this->str_html .= $datetime_format;
                  $this->str_html .= "</td>";
                break;
                case 'button':
                  $this->str_html .= "<td id='" . $item . "'>";
                  // <a href=". route(($item=="editar")?'clientes.update':'clientes.delete',['idcliente' => $value->$item])." role='button' aria-haspopup='true' aria-expanded='false' class='{$class_btn}'>{$icono_fa}</a>
                  $arr_config = $c['arr_config'];
                  $tolink =  $arr_config['link'];
                  $icono_fa = $arr_config['icon'];
                  $class_btn = $arr_config['class_btn'];
                  $accion = $arr_config['accion'];
                  $tooltip = isset($arr_config['tooltip'])?$arr_config['tooltip']:"";

                  if($accion == "to_route"){
                    $url = "<center> <a href=". base_url($tolink."/".$this->arr_datos[$i][$item])." class='{$class_btn}' title='{$tooltip}'>{$icono_fa}</a> </center>";
                  }
                  else{
                    $url = "<center> <a href='javascript:void(0)' class='{$class_btn}' onclick='{$accion}({$this->arr_datos[$i][$item]})' title='{$tooltip}'> {$icono_fa} </a></center>";
                  }

                  $this->str_html .= $url;
                  $this->str_html .= "</td>";
                break;
                case 'icono':
                break;
              }
              $cont_columnas++;
            }// end for columns
          $this->str_html .= "</tr>";
        }
      }
      else{
        $this->str_html .= "<tr>";
        $this->str_html .= "<td colspan='".count($this->arr_columns)."'>No hay datos para mostrar</td>";
        $this->str_html .= "</tr>";
      }

      $this->str_html .= "</tbody>";

      $this->str_html .= "</table>";
      $this->str_html .= "</div>";
    }// get_body()



        //creamos los enlaces de nuestra paginación
         public function get_paginador(){
            $function = ($this->funcion == "")?'get_gridpaginador':$this->funcion;
             $str_paginador = "";
             // echo "total ". $this->total_datos; die();
             //página actual
             $actual_pag = $_SESSION[PAGINA_ACTUAL_GRID];

             //limite por página
             $limit = $this->limit_values_paginador;
             //total de enlaces que existen
             $totalPag = floor($this->total_datos/$limit);
             // echo $totalPag;
             //links delante y detrás que queremos mostrar
             $pagVisibles = 2;

             if($actual_pag <= $pagVisibles){
                 $primera_pag = 1;
             }else{
                 $primera_pag = $actual_pag - $pagVisibles;
             }

             if(($actual_pag + $pagVisibles) <= $totalPag){
                 $ultima_pag = $actual_pag + $pagVisibles;
             }else{
                 $ultima_pag = $totalPag;
             }
             // echo $primera_pag;
             // die();

             $str_paginador .= "<nav class='div_paginador'><ul class='pagination pagination-sm'>";
             $str_paginador .= ($actual_pag > 1) ?
                                                "<li class='page-item'> <a  class='page-link' href='javascript:void(0)' onclick={$function}(0,".$limit.")>Primera</li></a>"
                                                :
                                                "<li class='page-item disabled'>   <a  class='page-link' href='javascript:void(0)'>Primera</li></a>";
             $str_paginador .= ($actual_pag > 1) ?
                                                "<li class='page-item'>   <a  class='page-link' href='javascript:void(0)' onclick={$function}(".(($actual_pag-2)*$limit).")><span aria-hidden='true'>&laquo;</span> </li></a>"
                                                :
                                                "<li class='page-item disabled'><a  class='page-link' href='javascript:void(0)'><span aria-hidden='true'>&laquo;</span></li></a>";

             for($i=$primera_pag; $i<=$ultima_pag+1; $i++){
                 $z = $i;
                 $str_paginador .= ($i == $actual_pag) ?
                                                "<li class='page-item disabled'>  <a  class='page-link'  href='javascript:void(0)'>".$i."</li></a>"
                                                :
                                                "<li class='page-item'><a  class='page-link' href='javascript:void(0)' onclick={$function}(".(($z-1)*$limit).")>".$i."</li></a>";
             }

             $str_paginador .= ($actual_pag < $totalPag) ?
                                                "<li class='page-item'><a  class='page-link' href='javascript:void(0)' onclick={$function}(".(($actual_pag)*$limit).")> <span aria-hidden='true'>&raquo;</span></li></a>"
                                                  :
                                                  "<li class='page-item disabled'><a  class='page-link' href='javascript:void(0)'><span aria-hidden='true'>&raquo;</span></li></a>";

             $str_paginador .= ($actual_pag < $totalPag) ?
                                                "<li class='page-item'><a  class='page-link' href='javascript:void(0)' onclick={$function}(".(($totalPag)*$limit).")>Última</li></a>"
                                                :
                                                "<li class='page-item disabled'>  <a  class='page-link' href='javascript:void(0)'>Última</li></a>";

             $str_paginador .= "</ul></nav>";


             $this->str_html .= $str_paginador;
             $str_paginador= NULL;
         }// get_paginador()

         public function get_offset($post){
             $offset = !isset($post["offset"]) || $post["offset"] == "undefined" ? 0 : $post["offset"];
             if($offset == 0){
                 $_SESSION[PAGINA_ACTUAL_GRID] = 1;
             }else{
                 $_SESSION[PAGINA_ACTUAL_GRID] = ($offset+VALORES_XPAGINA)/VALORES_XPAGINA;
             }
             return $offset;
         }// get_offset()

}// class
