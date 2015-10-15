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
        
        //月份
        //$counterArray = array();
        $redBallCounter = array();
        $blueBallCounter = array();
        
        for ($rb = 1; $rb <= 33; $rb++) $redBallCounter[$rb] = 0;
        for ($bb = 1; $bb <= 16; $bb++) $blueBallCounter[$bb] = 0;
        
        foreach ($this->drawResults as $drawResult)
        {
            $redBallCounter[ $drawResult->redBall1 ]++;
            $redBallCounter[ $drawResult->redBall2 ]++;
            $redBallCounter[ $drawResult->redBall3 ]++;
            $redBallCounter[ $drawResult->redBall4 ]++;
            $redBallCounter[ $drawResult->redBall5 ]++;
            $redBallCounter[ $drawResult->redBall6 ]++;
            $blueBallCounter[ $drawResult->blueBall ]++;
        }
        //$counters = '';
        //for ($month = 1; $month <= 12; $month++)
        //{
        //    if ($month!=1) $counters .= ',';
        //    $counters .= $counterArray[$month];
        //}
        //$dataChart1 = array(
        //    'chart_name_1' => '月份分布',
        //    'counters_1' => $counters
        //);
        //$data = array_merge($data, $dataChart1);
        $pie_data = array();
        for ($ball = 1; $ball <= 33; $ball++)
        {
            $pie_data[] = array(
                'label' => $ball,
                'value' => $redBallCounter[$ball],
                'color' => random_color(0, 128, 0, 128, 0, 128)
            );
        }
        $pie_data_json = json_encode($pie_data);
        $data['pie_data_json'] = $pie_data_json;
        
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
