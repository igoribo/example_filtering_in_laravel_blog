<?php

use App\Article;
use App\Tag;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    public function run()
    {

        $articles = [
            [
                'article_data' => [
                    'user_id' => 1,
                    'title' => 'Winter works',
                    'article_text' => 'Winter works text',
                ],
                'cat_tags_data' => [
                    'category_id' => 1,
                    'tags' => 'works',
                ]
            ], [
                'article_data' => [
                    'user_id' => 1,
                    'title' => 'Winter technic',
                    'article_text' => 'Winter technic text',
                ],
                'cat_tags_data' => [
                    'category_id' => 1,
                    'tags' => 'technic',
                ]
            ], [
                'article_data' => [
                    'user_id' => 1,
                    'title' => 'Spring works',
                    'article_text' => 'Spring works text',
                ],
                'cat_tags_data' => [
                    'category_id' => 2,
                    'tags' => 'works',
                ]
            ], [
                'article_data' => [
                    'user_id' => 1,
                    'title' => 'Summer works',
                    'article_text' => 'Summer works text',
                ],
                'cat_tags_data' => [
                    'category_id' => 3,
                    'tags' => 'technic',
                ]
            ], [
                'article_data' => [
                    'user_id' => 1,
                    'title' => 'Fall`s harvest',
                    'article_text' => 'Fall`s harvest text',
                ],
                'cat_tags_data' => [
                    'category_id' => 4,
                    'tags' => 'works,harvest',
                ]
            ],
        ];

        foreach($articles as $article_data){
            $article = Article::create($article_data['article_data']);
            $article->categories()->attach($article_data['cat_tags_data']['category_id']);
            $tags = explode(',', $article_data['cat_tags_data']['tags']);
            foreach ($tags as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $article->tags()->attach($tag);
            }
        }
    }
}
