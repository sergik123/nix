<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book=[];
        $name='название';
        $author='автор';
        $description='описание';
        $cover='image';
        $category='категория';

        for ($i=0; $i<50;$i++){
            $name='название '.$i;
            $author='автор '.rand(1,20);
            $description='описание '.$i;
            $cover='image'.$i;
            $category='категория '.rand(1,20);

            $book[]=[
                'name'=>$name,
                'author'=>$author,
                'description'=>$description,
                'cover'=>$cover,
                'category'=>$category
            ];
        }
        \DB::table('books')->insert($book);
    }
}
