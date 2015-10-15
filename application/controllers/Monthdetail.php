<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'core/LO_Controller.php' );

class Monthdetail extends LO_Controller {
    private $month;
    
    public function __construct(){
        parent::__construct();
    }
    
    public function __get_content()
    {
        $data = array(
            'month' => $this->month
        );
        
        $mCounter = array();
        for ($index = 1; $index <= 33; $index++) $mCounter[$index] = 0;
        for ($index = 101; $index <= 116; $index++) $mCounter[$index] = 0; 
        foreach ($this->drawResults as $drawResult)
        {
            if ($this->month == $drawResult->month)
            {
                $mCounter[ $drawResult->redBall1 ]++;
                $mCounter[ $drawResult->redBall2 ]++;
                $mCounter[ $drawResult->redBall3 ]++;
                $mCounter[ $drawResult->redBall4 ]++;
                $mCounter[ $drawResult->redBall5 ]++;
                $mCounter[ $drawResult->redBall6 ]++;
                $mCounter[ $drawResult->blueBall + 100 ]++;
            }
        }
        
        //生成标签
        $labelsRed = '';
        $labelsBlue = '';
        $labelsMixed = '';
        $colors = '';
        $theory_avg_red = count($this->drawResults) * 6 / 33 / 12;
        $theory_avg_blue = count($this->drawResults) / 16 / 12;
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
            $countersCSVRed .= $mCounter[$index];
        }
        for ($index=1; $index<=16; $index++)
        {
            if ($index != 1)
            {
                $countersCSVBlue .= ',';
            }
            $countersCSVBlue .= $mCounter[100+$index];
        }
        $countersMixed = $countersCSVRed . ',' . $countersCSVBlue;
        
        $data['labels'] = $labelsMixed;
        $data['counters'] = $countersMixed;
        $data['bar_colors'] = $colors;
        $data['theory_line'] = $theory_avg_arr;
        
        //解析模板
        return $this->parser->parse('monthdetail_content', $data, TRUE);
    }
    
    public function view($month)
    {
        $this->month = $month;
        $this->index();
    }
    
    public function __get_active_menu_item()
    {
        return 'histogram';
    }
    
    public function __get_page_name()
    {
        return '详情';
    }
}
