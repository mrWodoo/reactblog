<?php

use Phinx\Seed\AbstractSeed;

class PostsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $this->table('post')->truncate();

        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'title'         => $faker->title,
                'content'       => $faker->text(500),
                'short_content' => $faker->text(150),
                'created_at'    => date('Y-m-d ') . rand(0, 23) . ':' . rand(0, 59) . ':' . rand(0,59)
            ];
        }

        $this->insert('post', $data);
    }
}
