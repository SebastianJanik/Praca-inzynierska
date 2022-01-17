<?php

namespace Database\Seeders;

use App\Models\Statuses;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $name;
    private $modelStatuses;
    private $teamNames;
    private $towns;
    private $streets;
    private $number;

    public function __construct()
    {
        $this->name = (new Team())->getTable();
        $this->modelStatuses = new Statuses();
        $this->teamNames = ['Motor', 'Huragan', 'Górnik', 'Powiślak', 'POM', 'Sparta', 'Lewart', 'Lutnia', 'Kryształ', 'Stal', 'Granit', 'Gryf', 'Grom', 'Huczwa', 'Kłos', 'Igors', 'Start'];
        $this->towns = ['Bychawa', 'Kraśnik', 'Świdnik', 'Lublin', 'Zamość', 'Chełm', 'Krasnystaw', 'Krasnobród', 'Łęczna', 'Końskowola', 'Piotrowice', 'Łóków', 'Lubartów', 'Włodawa', 'Piszczac', 'Zakrzówek', 'Wilkołaz', 'Puławy', 'Nałęczów'];
        $this->streets = ['1 Maja', 'Bazylianów', 'Cicha', 'Długa', 'Fabryczna', 'Groszkowa', 'Hugo Kołłątaja', 'Ignacego Mościckiego', 'Jana Matejki', 'Krochmalna', 'Leopolda Staffa', 'Marii Curie-Skłodowskiej', 'Niepodległości', 'Okopowa', 'Plażowa', 'Robotnicza', 'Siewna', 'Tadeusza Kościuszki', 'Westerplatte', 'Zamojska'];
        $this->number = 23;
    }

    public function run()
    {
        $activeStatus = $this->modelStatuses->getStatus('active');
        for ($i = 0; $i < $this->number; $i++) {
            $town = $this->towns[array_rand($this->towns)];
            DB::table($this->name)->insert(
                [
                    'status_id' => $activeStatus,
                    'name' => $this->teamNames[array_rand($this->teamNames)].' '.$town,
                    'street' => $this->streets[array_rand($this->streets)],
                    'house_number' => rand(1, 100),
                    'postal_code' => rand(10,99).'-'.rand(100,999),
                    'town' => $town
                ]
            );
        }
    }
}
