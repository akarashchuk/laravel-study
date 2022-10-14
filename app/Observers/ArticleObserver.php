<?php

namespace App\Observers;

use App\Jobs\PublishedArticleEmail;
use App\Mail\NewArticle;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ArticleObserver
{
    /**
     * Handle the Article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        $isStatusChanged = $article->status !== $article->getOriginal('status');
//        $article->isDirty('clean');

        if ($isStatusChanged && $article->status === 'published') {
            PublishedArticleEmail::dispatch($article);
        }
    }
}
