<?php

namespace App\Providers;

use App\Models\AdditionalSpecificAttribute;
use App\Models\Application;
use App\Models\WallpaperCategory;

use App\Models\Language;
use App\Models\MusicRecord;
use App\Models\Musician;
use App\Models\MusicBand;
use App\Models\Account;
use App\Models\FaqCategory;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\User;
use App\Models\ArtCategory;
use App\Models\Artist;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.app_additional_specific_values.fields'], function ($view) {
            $additional_specific_attributeItems = AdditionalSpecificAttribute::pluck('name','uuid')->toArray();
            $view->with('additional_specific_attributeItems', $additional_specific_attributeItems);
        });
        View::composer(['admin.app_additional_specific_values.fields'], function ($view) {
            $applicationItems = Application::pluck('name','uuid')->toArray();
            $view->with('applicationItems', $applicationItems);
        });
        View::composer(['admin.app_additional_specific_values.index'], function ($view) {
            $additional_specific_attributeItems = AdditionalSpecificAttribute::pluck('name','uuid')->toArray();
            $view->with('additional_specific_attributeItems', $additional_specific_attributeItems);
        });
        View::composer(['admin.app_additional_specific_values.index'], function ($view) {
            $applicationItems = Application::pluck('name','uuid')->toArray();
            $view->with('applicationItems', $applicationItems);
        });

        View::composer(['admin.wallpapers.fields'], function ($view) {
            $wallpaper_categoryItems = WallpaperCategory::pluck('name','uuid')->toArray();
            $view->with('wallpaper_categoryItems', $wallpaper_categoryItems);
        });
        View::composer(['admin.music_lyrics.fields'], function ($view) {
            $languageItems = Language::pluck('name','uuid')->toArray();
            $view->with('languageItems', $languageItems);
        });
        View::composer(['admin.music_lyrics.fields'], function ($view) {
            $music_recordItems = MusicRecord::pluck('name','uuid')->toArray();
            $view->with('music_recordItems', $music_recordItems);
        });
        View::composer(['admin.musician_videos.fields'], function ($view) {
            $musicianItems = Musician::pluck('name','uuid')->toArray();
            $view->with('musicianItems', $musicianItems);
        });
        View::composer(['admin.musician_profile_pictures.fields'], function ($view) {
            $musicianItems = Musician::pluck('name','uuid')->toArray();
            $view->with('musicianItems', $musicianItems);
        });
        View::composer(['admin.musicians.fields'], function ($view) {
            $music_bandItems = MusicBand::pluck('name','uuid')->toArray();
            $view->with('music_bandItems', $music_bandItems);
        });
        View::composer(['admin.applications.fields'], function ($view) {
            $accountItems = Account::pluck('name','uuid')->toArray();
            $view->with('accountItems', $accountItems);
        });
        View::composer(['admin.users.fields'], function ($view) {
            $view->with('roleItems', Role::pluck('name', 'name')->toArray());
        });
    }
}
