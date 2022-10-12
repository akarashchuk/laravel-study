<?php

namespace App\Jobs;

use App\Mail\NewArticle;
use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PublishedArticleEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function handle(Article $article): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewArticle());
        }
    }
}
