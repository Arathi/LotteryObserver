<?php
/**
 * Created by Notepad++.
 * User: Arathi
 * Date: 2015/10/12
 * Time: 12:56
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Draw_result_rbb
{
    public $id;
    public $year;
    public $month;
    public $dayOfMonth;
    public $dayOfWeek; 
    public $redBall1;
    public $redBall2;
    public $redBall3;
    public $redBall4;
    public $redBall5;
    public $redBall6;
    public $blueBall;
    public $salesVolume;
    
    public function __construct($resultArray)
    {
        $this->id = $resultArray['id'];
        $timestamp = strtotime($resultArray['draw_date']);
        $this->year = date('Y', $timestamp);
        $this->month = date('n', $timestamp); //���ֱ�ʾ���·ݣ�û��ǰ����
        $this->dayOfMonth = date('j', $timestamp); //�·��еĵڼ��죬û��ǰ����
        $this->dayOfWeek = date('l', $timestamp); //���ڼ���Sunday �� Saturday
        $this->redBall1 = $resultArray['red_ball_1'];
        $this->redBall2 = $resultArray['red_ball_2'];
        $this->redBall3 = $resultArray['red_ball_3'];
        $this->redBall4 = $resultArray['red_ball_4'];
        $this->redBall5 = $resultArray['red_ball_5'];
        $this->redBall6 = $resultArray['red_ball_6'];
        $this->blueBall = $resultArray['blue_ball'];
        $this->salesVolume = $resultArray['sales_volume'];
    }
}
