<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $name;
    private $surnames;
    private $firstnames;
    private $towns;
    private $streets;
    private $numberOfPlayers;
    private $numberOfReferees;
    private $numberOfCoaches;
    private $numberOfUsers;
    private $today;
    private $userRole;

    public function __construct()
    {
        $this->name = (new User())->getTable();
        $this->surnames = ["Zwierzynski", "Lenarczyk", "Kupczak", "Kopecki", "Niedzwiecki", "Księżopolski", "Szypuła", "Wojtyczka", "Piasek", "Kożuchowski", "Porada", "Kawka", "Grzybowski", "Gaj", "Konopa", "Widomski", "Wypych", "Gogolewski", "Olbryś", "Patyk", "Dalecki", "Rybacki", "Ślusarczyk", "Polak", "Radzik", "Olszanko", "Królik", "Kiełczewski", "Sulikowski", "Ławrynowicz", "Górzyński", "Rypin", "Tomczuk", "Dziuba", "Stachowiak", "Spałek", "Smołka", "Krasnodębski", "Ptaszyński", "Goławski", "Poręba", "Kulczycki", "Durczak", "Kołodziej", "Kasztelan", "Matecki", "Piekarczyk", "Uchman", "Rykaczewski", "Kmiotek", "Łukaszewski", "Wydrzyński", "Walas", "Konieczny", "Kaliński", "Kida", "Cybula", "Staszak", "Kraski", "Janowicz", "Zarębski", "Mączyński", "Bajon", "Ligęza", "Stefański", "Jachym", "Toporowski", "Pawlak", "Bochniak", "Pilichowski", "Borowiec", "Serwatka", "Woźniczka", "Sójka", "Kotynia", "Rudek", "Łucki", "Wacławski", "Dyląg", "Salamon", "Trojnar", "Jaworowski", "Paszko", "Miecznikowski", "Molenda", "Wasielewski", "Sulewski", "Masztalerz", "Kalicki", "Konkol", "Toboła", "Pawełek", "Dębiec", "Mateja", "Kozieł", "Szlachetka", "Trzebiatowski", "Świętek", "Cabaj", "Roszkowski", "Stefaniuk", "Madeja", "Kreft", "Jarzębski", "Golec", "Fijołek", "Rosłaniec", "Domagała", "Wiktorowski", "Urbanik", "Ogrodnik", "Śpiewak", "Mazgaj", "Jóźwicki", "Bednarczyk", "Dłużniewski", "Pióro", "Goszczyński", "Adamus", "Chwałek", "Fojcik", "Cichecki", "Staniak", "Lasak", "Frąc", "Chabros", "Izdebski", "Karwowski", "Jamrozik", "Wasiak", "Wierzchowski", "Zębala", "Sosiński", "Pol", "Cieślewicz", "Ratajski", "Flak", "Nawara", "Czarkowski", "Przybyszewski", "Karpiński", "Bilicki", "Kulczyk", "Brzezicki", "Świtalski", "Józefiak", "Sucharski", "Pietras", "Faron", "Wantuch", "Piorun", "Stefan", "Babiak", "Kudelski", "Płoski", "Rosiński", "Gawęda", "Duch", "Suwalski", "Żakowski", "Graca", "Tomala", "Wojnarowski", "Tęcza", "Ozga", "Maroń", "Rogowski", "Puchała", "Szatan", "Wesołowski", "Wojda", "Godyń", "Tabaka", "Woronowicz", "Rój", "Tatara", "Hinc", "Machowski", "Konopko", "Kuźnicki", "Jakubiak", "Jasiak", "Kozina", "Luty", "Grzelak", "Magnuszewski", "Kamecki", "Lis", "Komenda", "Banaszek", "Homa", "Drzewiecki", "Pietruszka", "Góra", "Prusik", "Rybski", "Dąbrowski", "Miłosz", "Manowski", "Żmuda", "Kądziołka", "Pijanowski", "Kurzawski", "Skałecki", "Pilarz", "Michoń", "Konieczna", "Radziszewski", "Markuszewski", "Kalisz", "Szymankiewicz", "Kulesza", "Jędrychowski", "Pankowski", "Kowalczyk", "Czapiewski", "Biegaj", "Sitek", "Nitecki", "Mosakowski", "Kuźniar", "Hałas", "Lazar", "Głuch", "Frankowski", "Koziara", "Solarz", "Stanisławski", "Gruszczyński", "Środa", "Duszak", "Partyka", "Świerk", "Dworak", "Romanik", "Bartoszuk", "Paśnik", "Rogaczewski", "Dzierżanowski", "Cap", "Tutaj", "Pawelczyk", "Szmidt", "Baczewski", "Słupski", "Gromek", "Borsuk", "Lisek", "Kościelny", "Dobija", "Szczerba", "Bronowicki", "Ruszkiewicz", "Chmielecki", "Skupiński", "Rękas", "Jaszczuk", "Niewczas", "Żuber", "Kosakowski", "Tomanek", "Wojtan", "Mikuła", "Domagalski", "Bączkowski", "Głuszak", "Górny", "Grabiec", "Starosta", "Fil", "Cudak", "Depa", "Stolarski", "Beczek", "Jakubaszek", "Moroz", "Pikus", "Langer", "Migdał", "Jasiński", "Sokołowski", "Stachoń", "Zienkiewicz", "Sroka", "Kuczma", "Kajzer", "Żurowski", "Grzeszczak", "Joński", "Olender", "Kotarba", "Opara", "Zarychta", "Szarzyński", "Jarosławski", "Szczerbiński", "Niezgoda", "Staszczyk", "Olczyk", "Wiater", "Piwowarczyk", "Skoczeń", "Kubacki", "Stelmaszczyk", "Giera", "Opałka", "Jaśkowiak", "Kotowski", "Marciszewski", "Zapart", "Szczuka", "Pawlica", "Sałek", "Łopatka", "Hołub", "Czaplicki", "Haber", "Kolenda", "Bar", "Musik", "Moskal", "Dałek", "Skierski", "Szydlik", "Siemaszko", "Zajączkowski", "Kotliński", "Młynek", "Koziarski", "Grabarczyk", "Łukasiak", "Blicharz", "Zadrożna", "Zub", "Cesarz", "Ciosek", "Dziekan", "Bartosiński", "Ziobro", "Śnieżek", "Wnuk", "Sieroń", "Plewiński", "Siwiec", "Kusz", "Babula", "Kamionka", "Faliński", "Imiołek", "Barczewski", "Bagrowski", "Tomaszek", "Paszkiewicz", "Olejniczak", "Dembowski", "Kędzierski", "Danielak", "Krawczyński", "Ciszek", "Borycki", "Pakulski", "Grudzień", "Wasik", "Żebrowski", "Machalski", "Gierczak", "Wadas", "Schulz"];
        $this->firstnames = ["Piotr", "Krzysztof", "Andrzej", "Tomasz", "Jan", "Paweł", "Michał", "Marcin", "Stanisław", "Jakub", "Adam", "Marek", "Grzegorz", "Mateusz", "Wojciech", "Mariusz", "Dariusz", "Zbigniew", "Jerzy", "Maciej", "Rafał", "Robert", "Józef", "Kamil", "Jacek", "Tadeusz", "Dawid", "Ryszard", "Szymon", "Kacper", "Janusz", "Bartosz", "Jarosław", "Mirosław", "Sławomir", "Henryk", "Artur", "Sebastian", "Damian", "Patryk", "Kazimierz", "Przemysław", "Daniel", "Karol", "Roman", "Marian", "Wiesław", "Antoni", "Filip", "Adrian", "Arkadiusz", "Aleksander", "Dominik", "Bartłomiej", "Leszek", "Franciszek", "Waldemar", "Mikołaj", "Zdzisław", "Krystian", "Radosław", "Wiktor", "Bogdan", "Edward", "Mieczysław", "Konrad", "Władysław", "Hubert", "Czesław", "Igor", "Eugeniusz", "Oskar", "Stefan", "Bogusław", "Zygmunt", "Ireneusz", "Marcel", "Witold", "Maksymilian", "Sylwester", "Miłosz", "Włodzimierz", "Zenon", "Alan", "Oliwier", "Cezary", "Nikodem", "Norbert", "Leon", "Gabriel", "Julian", "Błażej", "Oleksandr", "Fabian", "Bronisław", "Ignacy", "Emil", "Eryk", "Wacław", "Tymoteusz", "Lech", "Bolesław", "Tymon", "Bernard", "Edmund", "Serhii", "Volodymyr", "Andrii", "Remigiusz", "Ksawery", "Natan", "Lucjan", "Olaf", "Romuald", "Borys", "Kajetan", "Szczepan", "Albert", "Seweryn", "Gracjan", "Alfred", "Kuba", "Dmytro", "Tobiasz", "Ivan", "Ludwik", "Joachim", "Mykola", "Lesław", "Bogumił", "Vasyl", "Gerard", "Vitalii", "Ernest", "Maksym", "Ihor", "Bruno", "Feliks", "Kornel", "Olivier", "Jędrzej", "Yurii", "Alojzy", "Viktor", "Oleh", "Alexander", "Alex", "Mykhailo", "Bohdan", "Juliusz", "Leonard", "Klaudiusz", "David", "Benedykt", "Aleks", "Dorian", "Rajmund", "Teodor", "Cyprian", "Martin", "Oliver", "Oleksii", "Vladyslav", "Rudolf", "Nataniel", "Konstanty", "Ruslan", "Denis", "Hieronim", "Brajan", "Gustaw", "Michael", "Wincenty", "Samuel", "Zygfryd", "Marceli", "Pavlo", "Florian", "Erwin", "Mieszko", "Kevin", "Fryderyk", "Ariel", "Denys", "Anatolii", "Iwo", "Vadym", "Milan", "Artem", "Aleksy", "Petro", "Beniamin", "Roland", "Sergiusz", "Walenty", "Yaroslav", "Kordian", "Adolf"];
        $this->streets = ['1 Maja', 'Bazylianów', 'Cicha', 'Długa', 'Fabryczna', 'Groszkowa', 'Hugo Kołłątaja', 'Ignacego Mościckiego', 'Jana Matejki', 'Krochmalna', 'Leopolda Staffa', 'Marii Curie-Skłodowskiej', 'Niepodległości', 'Okopowa', 'Plażowa', 'Robotnicza', 'Siewna', 'Tadeusza Kościuszki', 'Westerplatte', 'Zamojska'];
        $this->towns = ['Bychawa', 'Kraśnik', 'Świdnik', 'Lublin', 'Zamość', 'Chełm', 'Krasnystaw', 'Krasnobród', 'Łęczna', 'Końskowola', 'Piotrowice', 'Łóków', 'Lubartów', 'Włodawa', 'Piszczac', 'Zakrzówek', 'Wilkołaz', 'Puławy', 'Nałęczów'];
        $this->today = date("Y-m-d H:i:s");
        $this->numberOfPlayers = 115;
        $this->numberOfReferees = 5;
        $this->numberOfCoaches = 23;
        $this->numberOfUsers = 5;
        $this->userRole = Role::findByName('user');
    }

    public function run()
    {
        $this->players();
        $this->admin();
        $this->coaches();
        $this->referees();
        $this->users();
    }

    public function players()
    {
        $role = Role::findByName('player');
        for($i=1; $i <= $this->numberOfPlayers; $i++) {
            $id = DB::table($this->name)->insertGetId(
                [
                    'name' => $this->firstnames[array_rand($this->firstnames)],
                    'surname' => $this->surnames[array_rand($this->surnames)],
                    'date_birth' => rand(1989, 2005) . '-' . rand(1, 12) . '-' . rand(1, 28),
                    'street' => $this->streets[array_rand($this->streets)],
                    'house_number' => rand(1, 250),
                    'postal_code' => rand(10, 99) . '-' . rand(100, 999),
                    'town' => $this->towns[array_rand($this->towns)],
                    'email' => 'player'.$i.'@player.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => $this->today
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $role->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $this->userRole->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
        }
    }

    public function admin()
    {
        $role = Role::findByName('admin');
        $id = DB::table($this->name)->insertGetId(
            [
                'name' => 'admin',
                'surname' => 'admin',
                'date_birth' => rand(1989, 2005) . '-' . rand(1, 12) . '-' . rand(1, 28),
                'street' => $this->streets[array_rand($this->streets)],
                'house_number' => rand(1, 250),
                'postal_code' => rand(10, 99) . '-' . rand(100, 999),
                'town' => $this->towns[array_rand($this->towns)],
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'created_at' => $this->today
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id' => $role->id,
                'model_type' => 'App\Models\user',
                'model_id' => $id
            ]
        );
        DB::table('model_has_roles')->insert(
            [
                'role_id' => $this->userRole->id,
                'model_type' => 'App\Models\user',
                'model_id' => $id
            ]
        );
    }

    public function referees()
    {
        $role = Role::findByName('referee');
        for($i = 1; $i <= $this->numberOfReferees; $i++){
            $id = DB::table($this->name)->insertGetId(
                [
                    'name' => $this->firstnames[array_rand($this->firstnames)],
                    'surname' => $this->surnames[array_rand($this->surnames)],
                    'date_birth' => rand(1989, 2005) . '-' . rand(1, 12) . '-' . rand(1, 28),
                    'street' => $this->streets[array_rand($this->streets)],
                    'house_number' => rand(1, 250),
                    'postal_code' => rand(10, 99) . '-' . rand(100, 999),
                    'town' => $this->towns[array_rand($this->towns)],
                    'email' => 'referee'.$i.'@referee.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => $this->today
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $role->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $this->userRole->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
        }
    }

    public function coaches()
    {
        $role = Role::findByName('coach');
        for($i = 1; $i <= $this->numberOfCoaches; $i++){
            $id = DB::table($this->name)->insertGetId(
                [
                    'name' => $this->firstnames[array_rand($this->firstnames)],
                    'surname' => $this->surnames[array_rand($this->surnames)],
                    'date_birth' => rand(1989, 2005) . '-' . rand(1, 12) . '-' . rand(1, 28),
                    'street' => $this->streets[array_rand($this->streets)],
                    'house_number' => rand(1, 250),
                    'postal_code' => rand(10, 99) . '-' . rand(100, 999),
                    'town' => $this->towns[array_rand($this->towns)],
                    'email' => 'coach'.$i.'@coach.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => $this->today
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $role->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $this->userRole->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
        }
    }

    public function users()
    {
        $role = Role::findByName('user');
        for($i = 1; $i <= $this->numberOfUsers; $i++){
            $id = DB::table($this->name)->insertGetId(
                [
                    'name' => $this->firstnames[array_rand($this->firstnames)],
                    'surname' => $this->surnames[array_rand($this->surnames)],
                    'date_birth' => rand(1989, 2005) . '-' . rand(1, 12) . '-' . rand(1, 28),
                    'street' => $this->streets[array_rand($this->streets)],
                    'house_number' => rand(1, 250),
                    'postal_code' => rand(10, 99) . '-' . rand(100, 999),
                    'town' => $this->towns[array_rand($this->towns)],
                    'email' => 'user'.$i.'@user.com',
                    'password' => Hash::make('admin123'),
                    'created_at' => $this->today
                ]
            );
            DB::table('model_has_roles')->insert(
                [
                    'role_id' => $role->id,
                    'model_type' => 'App\Models\user',
                    'model_id' => $id
                ]
            );
        }
    }
}
