<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            ['id'=> '1','text' => 'Tujuan saya adalah menguasai materi yang disajikan di kelas secara keseluruhan', 'category_id' => 1],
            ['id'=> '2','text' => 'Saya berusaha melakukan yang terbaik dibandingkan siswa lain', 'category_id' => 3],
            ['id'=> '3','text' => 'Tujuan saya adalah belajar sebanyak mungkin', 'category_id' => 1],
            ['id'=> '4','text' => 'Tujuan saya adalah untuk berkinerja dengan baik tergantung pada siswa lainnya', 'category_id' => 3],
            ['id'=> '5','text' => 'Tujuan saya adalah menghindari ketidakmaksimalan belajar dari yang saya mampu', 'category_id' => 2],
            ['id'=> '6','text' => 'Tujuan saya adalah menghindari kinerja yang buruk dibandingkan yang lain', 'category_id' => 4],
            ['id'=> '7','text' => 'Saya berusaha memahami isi dari materi ini semaksimal mungkin', 'category_id' => 1],
            ['id'=> '8','text' => 'Tujuan saya adalah berkinerja lebih baik daripada siswa lain', 'category_id' => 3],
            ['id'=> '9','text' => 'Tujuan saya adalah menghindari ketidakmaksimalan belajar dari yang seharusnya dipelajari', 'category_id' => 2],
            ['id'=> '10','text' => 'Saya berusaha menghindari kinerja yang lebih buruk dari yang lain', 'category_id' => 4],
            ['id'=> '11','text' => 'Saya berusaha menghindari kurangnya pemahaman terhadap materi ini', 'category_id' => 2],
            ['id'=> '12','text' => 'Tujuan saya adalah menghindari pekerjaan yg lebih buruk dari siswa lain', 'category_id' => 4],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
