<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        if (Schema::hasColumn('articles', 'slug')) {
            \App\Models\Article::query()->chunk(10, function ($articles) {
                foreach ($articles as $article) {
                    $article->generateSlug();
                    $article->save();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('articles', 'slug')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
}
