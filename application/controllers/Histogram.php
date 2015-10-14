<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'core/LO_Controller.php' );

class Histogram extends LO_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function __addLibraries()
    {
        $this->__addJsLibrary('Echarts', '2.2.7', '/assets/echarts-all.js');
    }
    
    public function __get_content()
    {
        //生成标签
        $labelsRed = '';
        $labelsBlue = '';
        $labelsMixed = '';
        $colors = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1)
            {
                $labelsRed .= ',';
                $colors .= ',';
            }
            $labelsRed .= $index;
            $colors .= '\'#a00000\'';
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1) $labelsBlue .= ',';
            $labelsBlue .= $index;
            $colors .= ',\'#0000a0\'';
        }
        $labelsMixed = $labelsRed . ',' . $labelsBlue;
        //生成频数
        $countersCSVRed = '';
        $countersCSVBlue = '';
        $countersMixed = '';
        for ($index=1; $index<=33; $index++)
        {
            if ($index != 1) $countersCSVRed .= ',';
            $countersCSVRed .= $this->counter[$index];
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1) $countersCSVBlue .= ',';
            $countersCSVBlue .= $this->counter[100+$index];
        }
        $countersMixed = $countersCSVRed . ',' . $countersCSVBlue;
        
        $data = array(
            'labelsRed' => $labelsRed,
            'countersRed' => $countersCSVRed,
            'labelsBlue' => $labelsMixed,
            'countersBlue' => $countersCSVBlue,
            'labels' => $labelsMixed,
            'counters' => $countersMixed,
            'colors' => $colors
        );
        return $this->parser->parse('echarts_content', $data, TRUE);
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
