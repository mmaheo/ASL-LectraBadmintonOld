<?php

namespace App\Http\Controllers;

use App\PresentPeopleSportHall;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SportHallController extends Controller
{
    public static function routes($router)
    {

        $router->pattern('date', '[a-z]+');
        $router->pattern('sportHall_id', '[0-9]+');

        $router->get('index', [
            'uses' => 'SportHallController@index',
            'as'   => 'sportHall.index',
        ]);

        $router->get('create/{date}/{user_id}', [
            'uses' => 'SportHallController@create',
            'as'   => 'sportHall.create',
        ]);

        $router->get('delete/{sportHall_id}', [
            'uses' => 'SportHallController@delete',
            'as'   => 'sportHall.delete',
        ]);
    }

    public function index()
    {
        $presentPeopleYesterday = PresentPeopleSportHall::where('day', Carbon::yesterday())->get();
        $presentPeopleToday = PresentPeopleSportHall::where('day', Carbon::today())->get();
        $presentPeopleTomorrow = PresentPeopleSportHall::where('day', Carbon::tomorrow())->get();

        return view('sportHall.index', compact('presentPeopleYesterday', 'presentPeopleToday', 'presentPeopleTomorrow'));
    }

    public function create($date, $user_id)
    {
        $presentDate = null;

        $user = User::findOrFail($user_id);

        if ($date == 'today' || $date == 'tomorrow') {
            if ($date == 'today') {
                $presentDate = Carbon::today();
            } else if ($date == 'tomorrow') {
                $presentDate = Carbon::tomorrow();
            }

            //search if we are already at the sportHall
            $alreadyPresent = PresentPeopleSportHall::where('user_id', $user_id)->where('day', $presentDate)->count();

            if ($alreadyPresent == 0) {
                PresentPeopleSportHall::create([
                    'user_id' => $user_id,
                    'day'     => $presentDate
                ]);
                return redirect()->back()->with('success', "C'est bien vous faites du sport !");
            } else {
                return redirect()->back()->with('error', "Vous êtes déjà présent !");
            }

        }

        return redirect()->back()->with('error', "Vous ne pouvez y aller que aujourd'hui ou demain");
    }

    public function delete($sportHall_id)
    {
        $sportHall = PresentPeopleSportHall::findOrFail($sportHall_id);
        $sportHall->delete();

        return redirect()->back()->with('success', "Vous n'allez plus à la salle ...");
    }
}
