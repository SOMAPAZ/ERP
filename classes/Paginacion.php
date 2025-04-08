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
            $html .= "<a class=\"flex justify-center items-center border text-slate-800 hover:bg-slate-800 hover:border-transparent hover:text-white rounded px-2 py-1 bg-white font-bold text-xs shadow whitespace-nowrap dark:bg-slate-700 dark:border-transparent dark:text-white dark:hover:bg-slate-800\" href=\"?page={$this->pagina_anterior()}\">&laquo; Ant </a>";
        }
        return $html;
    }

    public function enlace_siguiente()
    {
        $html = '';
        if ($this->pagina_siguiente()) {
            $html .= "<a class=\"flex justify-center items-center border text-slate-800 hover:bg-slate-800 hover:border-transparent hover:text-white rounded px-2 py-1 bg-white font-bold text-xs shadow whitespace-nowrap dark:bg-slate-700 dark:border-transparent dark:text-white dark:hover:bg-slate-800\" href=\"?page={$this->pagina_siguiente()}\">Sig &raquo;</a>";
        }
        return $html;
    }

    public function numeros_paginas()
    {
        $html = '<div class="text-gray-500 font-medium hidden 2xl:block">';
        for ($i = 1; $i <= $this->total_paginas(); $i++) {
            if ($i === $this->pagina_actual) {
                $html .= "<span class=\"inline-flex items-center justify-center w-7 h-7 font-bold border border-transparent text-xs text-white bg-slate-800 text-white dark:border-transparent dark:hover:bg-slate-700\">{$i}</span>";
            } else {
                $html .= "<a class=\"inline-flex items-center justify-center bg-white shadow w-7 h-7 font-medium border hover:bg-slate-800 hover:border-transparent text-xs hover:bg-gray-600 hover:text-white dark:bg-slate-700 dark:border-slate-600 dark:border-transparent dark:hover:bg-slate-800 dark:text-white\" href=\"?page={$i}\">{$i}</a>";
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
