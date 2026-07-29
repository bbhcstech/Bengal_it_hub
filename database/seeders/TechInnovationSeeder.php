<?php

namespace Database\Seeders;

use App\Models\RssSource;
use App\Models\TechNewsCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechInnovationSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'General Tech' => [
                ['TechCrunch', 'https://techcrunch.com/feed/'],
                ['WIRED', 'https://www.wired.com/feed/rss'],
                ['The Verge', 'https://www.theverge.com/rss/index.xml'],
                ['Ars Technica', 'https://feeds.arstechnica.com/arstechnica/index'],
                ['ZDNET', 'https://www.zdnet.com/news/rss.xml'],
                ['Computerworld', 'https://www.computerworld.com/index.rss'],
                ['Engadget', 'https://www.engadget.com/rss.xml'],
                ['CNET', 'https://www.cnet.com/rss/news/'],
            ],
            'Artificial Intelligence' => [
                ['OpenAI Blog', 'https://openai.com/news/rss.xml'],
                ['Google AI Blog', 'https://blog.google/technology/ai/rss/'],
            ],
            'Cyber Security' => [
                ['Krebs on Security', 'https://krebsonsecurity.com/feed/'],
                ['Dark Reading', 'https://www.darkreading.com/rss.xml'],
                ['BleepingComputer', 'https://www.bleepingcomputer.com/feed/'],
            ],
            'Programming & Developers' => [
                ['GitHub Blog', 'https://github.blog/feed/'],
                ['Stack Overflow Blog', 'https://stackoverflow.blog/feed/'],
                ['CSS-Tricks', 'https://css-tricks.com/feed/'],
                ['Smashing Magazine', 'https://www.smashingmagazine.com/feed/'],
                ['DEV Community', 'https://dev.to/feed'],
            ],
            'Cloud Computing' => [
                ['AWS Blog', 'https://aws.amazon.com/blogs/aws/feed/'],
                ['Microsoft Azure', 'https://azure.microsoft.com/en-us/blog/feed/'],
            ],
            'Technology Business' => [
                ['TechCrunch Startups', 'https://techcrunch.com/category/startups/feed/'],
                ['Crunchbase News', 'https://news.crunchbase.com/feed/'],
                ['VentureBeat', 'https://venturebeat.com/feed/'],
                ['CNBC Technology', 'https://www.cnbc.com/id/19854910/device/rss/rss.html'],
            ],
            'Indian Technology' => [
                ['YourStory', 'https://yourstory.com/feed'],
            ],
        ];

        $sortOrder = 0;
        foreach ($categories as $categoryName => $sources) {
            $category = TechNewsCategory::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                ['name' => $categoryName, 'sort_order' => $sortOrder++]
            );

            foreach ($sources as [$sourceName, $feedUrl]) {
                RssSource::firstOrCreate(
                    ['slug' => Str::slug($sourceName)],
                    [
                        'tech_news_category_id' => $category->id,
                        'name' => $sourceName,
                        'feed_url' => $feedUrl,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
