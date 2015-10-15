<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'core/LO_Controller.php' );

class Histogram extends LO_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function __addLibraries()
    {
        $this->__addJsLibrary('Echarts', '2.2.7', '/assets/echarts.min.js');
    }
    
    public function __get_content()
    {
        //生成标签
        $labelsRed = '';
        $labelsBlue = '';
        $labelsMixed = '';
        $colors = '';
        $theory_avg_red = count($this->drawResults) * 6 / 33;
        $theory_avg_blue = count($this->drawResults) / 16;
        $theory_avg_arr = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1)
            {
                $labelsRed .= ',';
                $colors .= ',';
                $theory_avg_arr .= ',';
            }
            $labelsRed .= $index;
            $colors .= '\'#a00000\'';
            $theory_avg_arr .= $theory_avg_red;
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1)
            {
                $labelsBlue .= ',';
            }
            $labelsBlue .= $index;
            $colors .= ',\'#0000a0\'';
            $theory_avg_arr .= ',' . $theory_avg_blue;
        }
        $labelsMixed = $labelsRed . ',' . $labelsBlue;
        //生成频数
        $countersCSVRed = '';
        $countersCSVBlue = '';
        $countersMixed = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1)
            {
                $countersCSVRed .= ',';
            }
            $countersCSVRed .= $this->counter[$index];
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1)
            {
                $countersCSVBlue .= ',';
            }
            $countersCSVBlue .= $this->counter[100+$index];
        }
        $countersMixed = $countersCSVRed . ',' . $countersCSVBlue;
        
        $data = array(
            'chart_name' => '红蓝球频率直方图',
            'labels' => $labelsMixed,
            'counters' => $countersMixed,
            'colors' => $colors,
            'theory_avg' => $theory_avg_arr
        );
        return $this->parser->parse('histogram_content', $data, TRUE);
    }
    
    public function __get_active_menu_item()
    {
        return 'histogram';
    }
    
    public function __get_page_name()
    {
        return '频数直方图';
    }
}
