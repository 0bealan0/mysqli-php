<?php

class interfaz
{
    public static function listado_tabla($listado, $campos)
    {
        $html = "<table><tr>";

        foreach ($campos as $campo) {
            $html .= "<th>$campo</th>";
        }
        $html .= "</tr>";



        foreach ($listado as $fila)
        {
            $html .= "<tr>";
            $html .= "<form action='index.php' method='post'>";
            foreach ($fila as $campo)
            {
                $html .= "<td>$campo</td>";
            }

            $html .= "<td><input type='submit' class='btn btn-success' name='submit' value='editar'></td>
                      <td><input type='submit' class='btn btn-danger' name='submit' value='borrar'></td>
                      <td><input type='hidden'  name='id' value='{$fila['ID']}'> </td>";
            $html.="</form>";
            $html.="</tr>";

        }
        $html.="</table>";


        return $html;
    }
}

