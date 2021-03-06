<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameTag;
use App\Models\Wishlist;
use App\Models\Developer;
use App\Models\GameGenre;
use App\Models\GameReview;
use App\Models\GameLibrary;
use App\Models\GamePayment;
use App\Models\GameDonation;
use Illuminate\Http\Request;
use PharIo\Manifest\Library;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function setLang(){
        if(request()->session()->get('locale') != null){
            App::setLocale(request()->session()->get('locale'));
        }
    }

    private function calculateRating($game_id)
    {
        return DB::table('game_reviews')
            ->where('game_id', $game_id)
            ->avg('rating');
    }

    public function loginPage()
    {
        $this->setLang();
        return view('login', [
            'active' => 'Login',
            'category_nav' => GameGenre::get(),
        ]);
    }

    public function registerPage()
    {
        $this->setLang();
        return view('register', [
            'active' => '',
            'category_nav' => GameGenre::get(),
        ]);
    }

    public function dashboard()
    {
        $this->setLang();
        //discover games
        $new_game = Game::getGamebyTag('#new')->where('status', 'published');
        $promo_game = Game::getGamebyTag('#promotion')->where('status', 'published');
        $sale_game = Game::getGamebyTag('#sale')->where('status', 'published');
        $free_game = Game::where('price', 0)->where('status', 'published')->orderBy('updated_at', 'desc')->first();
        $genres = GameGenre::all();
        // @dd($new_game);

        return view('frontend.dashboard', [
            'category_nav' => GameGenre::get(),
            'active' => 'Home',
            'new_game' => $new_game,
            'promo_game' => $promo_game,
            'sale_game' => $sale_game,
            'genres' => $genres,
            'free_game' => $free_game,
            'games' => Game::all(),
        ]);
    }

    public function searchPage(Request $request)
    {
        $this->setLang();
        return view('frontend.search', [
            'request' => $request->search,
            'category_nav' => GameGenre::get(),
            'active' => '',
            'search_result' => Game::getGamebySearch($request->search),
        ]);
    }

    public function allGame(){
        $this->setLang();
        $games = Game::with(['gameGenre', 'gameReviews'])->where('status', 'published')->get();
        $sale_game = Game::getGamebyTag('#sale');

        return view('frontend.allGames', [
            'category_nav' => GameGenre::get(),
            'active' => 'All Games',
            'games' => $games,
            'sale_game' => $sale_game
        ]);
    }

    public function gameDetail(Request $request)
    {
        $this->setLang();
        $isOnWishlist = false;
        $isBought = false;
        $myReview = null;

        if(Auth::check() && Auth::user()->role != 'admin'){
            $isOnWishlist = Wishlist::where('game_id', $request->id)->where('user_id', Auth::user()->id)->first();
            $isBought = GameLibrary::where('game_id', $request->id)->where('user_id', Auth::user()->id)->first();
            $myReview = GameReview::where('game_id', $request->id)->where('user_id', Auth::user()->id)->first();
        }

        return view('frontend.gameDetail', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'total_download' => GamePayment::where('game_id', $request->id)->count(),
            'isBought' => $isBought,
            'isOnWishlist' => $isOnWishlist,
            'myReview' => $myReview,
            'donations' => GameDonation::with('user')->where('game_id', $request->id)->orderBy('created_at', 'desc')->get(),
            'reviews' => GameReview::where('game_id', $request->id)->orderBy('created_at', 'desc')->get(),
            'game' => Game::where('status', 'published')->find($request->id), //Belum di fix N+1 problem , kasih with(['table_name'])
        ]);
    }

    public function gameCategory(Request $request)
    {
        $this->setLang();
        $games = Game::with(['gameGenre', 'gameReviews'])->where('status', 'published')->where('genre_id', $request->id)->get();
        $sale_game = Game::getGamebyTag('#sale');

        return view('frontend.gameCategory', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'genre' => GameGenre::find($request->id),
            'games' => $games,
            'sale_game' => $sale_game
        ]);
    }

    public function gamebyTag(Request $request)
    {
        $this->setLang();
        $sale_game = Game::getGamebyTag('#sale');
        return view('frontend.gamebyTags', [
            'category_nav' => GameGenre::get(),
            'active' => '',
            'sale_game' => $sale_game,
            'tag' => GameTag::find($request->id),
            'games' => Game::getGamebyTagID($request->id)
        ]);

        // dump(Game::getGamebyTagID($request->id));
    }

    public function companyDetail (Request $request) {
        $this->setLang();
        $sale_game = Game::getGamebyTag('#sale');
        // dump($sale_game);

        $game =  Game::where('dev_id', $request->id);
        $isDev = Auth::check() && Auth::user()->developer != null && Auth::user()->developer->id == $request->id;
        if($isDev){
            //show unpublish
            $game = $game->get();
        }
        else{
            $game = $game->where('status', 'published')->get();
        }

        return view('frontend.companyDetail', [
            'category_nav' => GameGenre::get(),
            'active' => 'Developer',
            'company' => Developer::find($request->id),
            'games' =>$game,
            'isDev' => $isDev,
            'sale_game' => $sale_game,
            'genres' => GameGenre::all(),
        ]);
    }
}
