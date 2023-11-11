<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    public function index()
    {
        $user_data = [];
        $club_data = [];
        $categories = Category::all();
        
        foreach ($categories as $category_item) {
            // $items_count = Auth::user()
            //             ->withCount(['photos' => function (Builder $query) use ($category_item) {
            //                 $query->where('category_id','like',$category_item->id);
            //             }])
            //             ->get();
            // $data[$category_item->name] = $items_count[0]->photos_count;

            $date = now();
            $id = $category_item->id;
            $user_count = Auth::user()
                            ->photos()
                            ->where('category_id',$id)
                            ->whereYear('submitted_at', $date->format('Y'))
                            ->count('name');
            #$user_data[$category_item->name] = $user_count;
            $user_data['series'][] = $user_count;
            $user_data['chartOptions']['labels'][] = $category_item->name;
            $user_data['chartOptions']['title']['text'] = 'Your submissions';
            $user_data['chartOptions']['title']['style']['color'] = '#FFFFFF';
            $user_data['chartOptions']['chart']['foreColor'] = 'FFFFFF';
            $user_data['chartOptions']['colors'] = [
                '#d9ed92', 
                '#b5e48c', 
                '#99d98c', 
                '#76c893', 
                '#52b69a',
                '#34a0a4',
                '#168aad',
                '#1a759f',
                '#1e6091',
                '#184e77',
            ];

            $club_count = Photo::where('category_id',$id)
                            ->whereYear('submitted_at', $date->format('Y'))
                            ->count('name');
            #$club_data[$category_item->name] = $club_count;
            $club_data['series'][] = $club_count;
            $club_data['chartOptions']['labels'][] = $category_item->name;
            $club_data['chartOptions']['title']['text'] = 'Club submissions';
            $club_data['chartOptions']['title']['style']['color'] = '#FFFFFF';
            $club_data['chartOptions']['chart']['foreColor'] = 'FFFFFF';
            $club_data['chartOptions']['colors'] = [
                '#d9ed92', 
                '#b5e48c', 
                '#99d98c', 
                '#76c893', 
                '#52b69a',
                '#34a0a4',
                '#168aad',
                '#1a759f',
                '#1e6091',
                '#184e77',
            ];
        }
        
        
        
        
        return inertia('Dashboard',
        [
            'user_data' => $user_data,
            'club_data' => $club_data,
        ]);
    }
}
