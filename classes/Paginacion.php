<?php

namespace Classes;

class Paginacion
{
    public $pagina_actual;
    public $registros_por_pagina;
    public $total_registros;

    public function __construct($pagina_actual = 1, $registros_por_pagina = 10, $total_registros = 0)
    {
        $this->pagina_actual = (int) $pagina_actual;
        $this->registros_por_pagina = (int) $registros_por_pagina;
        $this->total_registros = (int) $total_registros;
    }

    public function offset()
    {
        return $this->registros_por_pagina * ($this->pagina_actual - 1);
    }

    public function total_paginas()
    {
        $total = ceil($this->total_registros / $this->registros_por_pagina);
        $total == 0 ? $total = 1 : $total = $total;
        return $total;
    }

    public function pagina_anterior()
    {
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }

    public function pagina_siguiente()
    {
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->total_paginas()) ? $siguiente : false;
    }

    public function enlace_anterior()
    {
        $html = '';
        if ($this->pagina_anterior()) {
            $html .= "<a class=\"flex justify-center items-center border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded px-2 py-1 bg-white font-bold text-xs shadow whitespace-nowrap dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:hover:bg-indigo-800\" href=\"?page={$this->pagina_anterior()}\">&laquo; Ant </a>";
        }
        return $html;
    }

    public function enlace_siguiente()
    {
        $html = '';
        if ($this->pagina_siguiente()) {
            $html .= "<a class=\"flex justify-center items-center border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded px-2 py-1 bg-white font-bold text-xs shadow whitespace-nowrap dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:hover:bg-indigo-800\" href=\"?page={$this->pagina_siguiente()}\">Sig &raquo;</a>";
        }
        return $html;
    }

    public function numeros_paginas()
    {
        $html = '<div class="text-indigo-800 text-sm font-medium hidden xl:block">';
        for ($i = 1; $i <= $this->total_paginas(); $i++) {
            if ($i === $this->pagina_actual) {
                $html .= "<span class=\"inline-flex items-center justify-center w-9 h-6 border font-bold border-indigo-600 text-xs text-indigo-600 bg-indigo-600 text-white dark:bg-gray-900 dark:border-gray-500 dark:text-white\">{$i}</span>";
            } else {
                $html .= "<a class=\"inline-flex items-center justify-center bg-white shadow w-6 h-6 font-medium border border-indigo-600 text-xs text-indigo-600 hover:bg-indigo-600 hover:text-white dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:hover:bg-indigo-800\" href=\"?page={$i}\">{$i}</a>";
            }
        }
        $html .= '</div>';

        return $html;
    }

    public function paginacion()
    {
        $html = '';
        if ($this->total_registros > 1) {
            $html .= '<div class="flex justify-between items-center mt-5 text-xs gap-3 py-5">';
            $html .= $this->enlace_anterior();
            $html .= $this->numeros_paginas();
            $html .= $this->enlace_siguiente();
            $html .= '</div>';
        }

        return $html;
    }
}
