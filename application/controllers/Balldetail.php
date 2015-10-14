<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once( APPPATH . 'core/LO_Controller.php' );

class Balldetail extends LO_Controller {
    private $ballNumber;
    
    public function __construct(){
        parent::__construct();
    }
    
    public function __get_content()
    {
        $data = array(
            'ball_name' => '红球'.$this->ballNumber
        );
        //月份
        $counterArray = array();
        for ($month = 1; $month <= 12; $month++) $counterArray[$month] = 0;
        foreach ($this->drawResults as $drawResult)
        {
            if ($drawResult->redBall1 == $this->ballNumber ||
                $drawResult->redBall2 == $this->ballNumber ||
                $drawResult->redBall3 == $this->ballNumber ||
                $drawResult->redBall4 == $this->ballNumber ||
                $drawResult->redBall5 == $this->ballNumber ||
                $drawResult->redBall6 == $this->ballNumber
            ) $counterArray[$drawResult->month]++;
        }
        $counters = '';
        for ($month = 1; $month <= 12; $month++)
        {
            if ($month!=1) $counters .= ',';
            $counters .= $counterArray[$month];
        }
        $dataChart1 = array(
            'chart_name_1' => '月份分布',
            'counters_1' => $counters
        );
        $data = array_merge($data, $dataChart1);
        
        //日
        $days = '';
        for ($day = 1; $day <= 31; $day++)
        {
            if ($day != 1) $days .= ',';
            $days .= $day;
        }
        $counterArray = array();
        $dcArray = array();
        for ($day = 1; $day <= 31; $day++)
        {
            $dcArray[$day] = 0;
            $counterArray[$day] = 0;
        }
        foreach ($this->drawResults as $drawResult)
        {
            $dcArray[ $drawResult->dayOfMonth ]++;
            if ($drawResult->redBall1 == $this->ballNumber ||
                $drawResult->redBall2 == $this->ballNumber ||
                $drawResult->redBall3 == $this->ballNumber ||
                $drawResult->redBall4 == $this->ballNumber ||
                $drawResult->redBall5 == $this->ballNumber ||
                $drawResult->redBall6 == $this->ballNumber
            ) $counterArray[$drawResult->dayOfMonth]++; 
        }
        $counters = '';
        $proportions = '';
        for ($d=1; $d<=31; $d++)
        {
            if ($d!=1)
            {
                $counters .= ',';
                $proportions .= ',';
            }
            $counters .= $counterArray[$d];
            $proportions .= 100 * $counterArray[$d] / $dcArray[$d];
        }
        $dataChart2 = array(
            'chart_name_2' => '日期分布',
            'days' => $days,
            'counters_2' => $counters,
            'proportion_2' => $proportions
        );
        $data = array_merge($data, $dataChart2);
        
        //解析模板
        return $this->parser->parse('balldetail_content', $data, TRUE);
    }
    
    public function view($ballNumber)
    {
        $this->ballNumber = $ballNumber;
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
