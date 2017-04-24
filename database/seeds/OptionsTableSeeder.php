<?php

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Option;

class OptionsTableSeeder extends Seeder
{
    public function run()
    {
        Option::truncate();

        $options = array(
            array(
                'key' => 'site.name',
                'value' => 'My Site Name',
            ),
            array(
                'key' => 'site.slogan',
                'value' => 'The Great Website!',
            ),
            array(
                'key' => 'site.description',
                'value' => 'My Site.',
            ),
            array(
                'key' => 'site.keywords',
                'value' => 'pingpong, gravitano',
            ),
            array(
                'key' => 'tracking',
                'value' => '<!-- GA Here -->',
            ),
            array(
                'key' => 'facebook.link',
                'value' => 'https://www.facebook.com/pingponglabs',
            ),
            array(
                'key' => 'twitter.link',
                'value' => 'https://twitter.com/pingponglabs',
            ),
            array(
                'key' => 'post.permalink',
                'value' => '{slug}',
            ),
            array(
                'key' => 'ckfinder.prefix',
                'value' => 'packages/pingpong/admin',
            ),
            array(
                'key' => 'admin.theme',
                'value' => 'default',
            ),
            array(
                'key' => 'pagination.perpage',
                'value' => 10,
            ),
            array(
                'key' => 'site.logo',
                'value' => '',
            ),
            array(
                'key' => 'site.footer.logo',
                'value' => '',
            ),
            array(
                'key' => 'site.favicon',
                'value' => '',
            ),
            array(
                'key' => 'site.email',
                'value' => 'admin@gmail.com',
            ),
            array(
                'key' => 'google.link',
                'value' => 'https://www.google.com',
            ),
            array(
                'key' => 'site.hotline',
                'value' => '33534355',
            ),
            array(
                'key' => 'site.android',
                'value' => 'https://www.google.com',
            ),
            array(
                'key' => 'site.apple',
                'value' => 'https://www.google.com',
            ),
            array(
                'key' => 'site.youtube',
                'value' => 'https://www.youtube.com',
            ),
            array(
                'key' => 'site.linkedin',
                'value' => 'https://www.linkedin.com',
            ),
            array(
                'key' => 'site.rss',
                'value' => '',
            ),
            array(
                'key' => 'site.mail',
                'value' => 'web@google.com',
            ),
            array(
                'key' => 'site.alert',
                'value' => '',
            ),
            array(
                'key' => 'site.template',
                'value' => 'default',
            ),
            array(
                'key' => 'site.copyright',
                'value' => 'Copyright MY SITE NAME 2017',
            ),
        );

        foreach ($options as $option) {
            Option::create($option);
        }
    }
}
