<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameTag;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPagesController extends Controller
{
    private function setLang()
    {
        if (request()->session()->get('locale') != null) {
            App::setLocale(request()->session()->get('locale'));
        }
    }

    public function pendingGamePage(){
        $this->setLang();
        return view('admin.pendingGame', [
            'active' => 'Admin',
            'category_nav' => GameGenre::get(),
            'games' => Game::where('status', 'pending')->get(),
            'genres' => GameGenre::all(),
        ]);
    }

    public function detailGamePage(Request $request){
        $this->setLang();
        return view('admin.pendingGameDetail', [
            'active' => '',
            'category_nav' => GameGenre::get(),
            'game' => Game::find($request->id),
            'genres' => GameGenre::all(),
        ]);
    }

    public function publishGame(Request $request){
        $this->setLang();

        $game = Game::find($request->game_id);
        $game->status = 'published';
        $game->save();
        Alert::success('Success', 'Game has been published');

        return redirect('/admin/pending');
    }

    public function denyGame(Request $request){
        $this->setLang();

        $game = Game::find($request->game_id);
        $game->status = 'denied';
        $game->save();
        Alert::success('Success', 'Game has been denied');

        return redirect('/admin/pending');
    }

    public function manageTagsPage()
    {
        $this->setLang();
        return view('admin.manageTag', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Tags' => GameTag::get()
        ]);
    }

    public function addTagPage()
    {
        $this->setLang();
        return view('admin.addTag', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Tags' => GameTag::get()
        ]);
    }

    public function updateTagPage(Request $request)
    {
        $this->setLang();
        return view('admin.updateTag', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Tag' => GameTag::find($request->id)
        ]);
    }

    public function manageGenresPage()
    {
        $this->setlang();
        return view('admin.manageGenre', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Genres' => GameGenre::get(),
        ]);
    }

    public function addGenrePage()
    {
        $this->setlang();
        return view('admin.addGenre', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Genres' => GameGenre::get(),
        ]);
    }

    public function updateGenrePage(Request $request)
    {
        $this->setlang();
        return view('admin.updateGenre', [
            'category_nav' => GameGenre::get(),
            'active' => 'Admin',
            'User' => Auth::user(),
            'Genre' => GameGenre::find($request->id),
        ]);
    }
}
