<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mul_rows = [
            [
                'title' => 'post1',
                'description' => 'post1description',
                'status' => '1',
                'create_user_id' => '1',
                'updated_user_id' => '1',
            ],
            [
                'title' => 'post2',
                'description' => 'post2description',
                'status' => '1',
                'create_user_id' => '1',
                'updated_user_id' => '1',
            ]

        ];
        foreach($mul_rows as $rows){
            $insert= DB::table('posts')->insert($rows);
        }
    }
}
