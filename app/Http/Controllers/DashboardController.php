<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Charts\AdoptedChart;
use App\Charts\RescuedChart;
use App\Charts\InjuriesChart;

use App\Models\User;

class DashboardController extends Controller
{
    public function __construct(){
        $this->bgcolor = collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]);
    }

    public function index(){
      
     $injuries = DB::table('injuries AS in')
         ->join('animal_injury AS ai','in.id','=','ai.injury_id')
         ->join('animals AS ani','ai.animal_id','=','ani.id')
         ->groupBy('in.injury_Name')
         ->pluck(DB::raw('count(in.injury_Name) AS total'),'in.injury_Name')
         ->all();

     $injuriesChart = new InjuriesChart;
      $dataset = $injuriesChart->labels(array_keys($injuries));
        $dataset= $injuriesChart->dataset('Animal Rescued Injuries Demographics', 'pie', array_values($injuries));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $injuriesChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>false,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);

        $adopted = DB::table('adopters AS adopt')
         ->join('adopter_animal AS aa','adopt.id','=','aa.adopter_id')
         ->join('animals AS ani','aa.animal_id','=','ani.id')
         ->select(DB::raw('count(adopt.created_at) AS total'),DB::raw('MONTHNAME(adopt.created_at) as month'))
         ->groupBy('month')
         ->pluck(DB::raw('count(month) AS total'),'month')
         ->all();

        $adoptedChart = new AdoptedChart;

        $dataset = $adoptedChart->labels(array_keys($adopted));

        $dataset= $adoptedChart->dataset('Adopted Animals Demographics', 'horizontalBar', array_values($adopted));
   
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $adoptedChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],

                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barThickness' => 100,
                            'barPercentage' => 1,
                            'gridLines' => ['display' => false],
                            'display' => true,
                            'ticks' => [
                             'beginAtZero' => true,
                             'min'=> 0,
                             'stepSize'=> 10,
                        ]
                    ]],
                 ],
        ]);


      $rescued = DB::table('rescuers AS res')
         ->join('animal_rescuer AS ar','res.id','=','ar.rescuer_id')
         ->join('animals AS ani','ar.animal_id','=','ani.id')
         ->select(DB::raw('count(res.created_at) AS total'),DB::raw('MONTHNAME(res.created_at) as month'))

         ->groupBy('month')
         // ->get();
         // ->groupBy('res.created_at')
         ->pluck(DB::raw('count(month) AS total'),'month')
         ->all();
      // dd($rescued);
        $rescuedChart = new RescuedChart;

        $dataset = $rescuedChart->labels(array_keys($rescued));

        $dataset= $rescuedChart->dataset('Rescued Animals Demographics', 'horizontalBar', array_values($rescued));
   
        $dataset= $dataset->backgroundColor(collect(["#39CCCC","#01FF70", "#85144b","#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $rescuedChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],

                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barThickness' => 100,
                            'barPercentage' => 1,
                            'gridLines' => ['display' => false],
                            'display' => true,
                            'ticks' => [
                             'beginAtZero' => true,
                             'min'=> 0,
                             'stepSize'=> 10,
                        ]
                    ]],
                 ],
        ]);

   
     return view('dashboard.index',compact('adoptedChart','rescuedChart','injuriesChart'));
    }
}
