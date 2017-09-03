<?php

class MainController extends BaseController {

    /**
     * show main page
     * @return mixed
     */
	public function showMain()
	{
		return View::make('main');
	}

    /**
     * show all users from database with pagination
     * @return mixed
     */
    public function showUsers()
    {
        // start runtime calculator
        $script_start_time = microtime(true);

        // get all users
        $number_of_users = User::count();
        $users = User::get();
		$users_university_list = [];

		// find each user university and buil temp array to store from current collection - 1 query per user with lazy loading
		foreach($users as $user){
			$current_user_university = University::where('id', '=', (int)$user['university_id'])->get();
			$users_uni['id'] = $user->id;
			$users_uni['username'] = $user->username;
			$users_uni['first_name'] = $user->first_name;
			$users_uni['last_name'] = $user->last_name;
			$users_uni['avatar'] = $user->avatar;
			$users_uni['email'] = $user->email;
			$users_uni['university_id'] = $user->university_id;
			$users_uni['university_name'] = $current_user_university[0]['university'];
			$users_uni['created_at'] = $user->created_at;
			$users_uni['updated_at'] = $user->updated_at;

			//add to array
			array_push($users_university_list, $users_uni);
		}

        $number_fetched = $users->count();

        $script_end_time = microtime(true);
        $time_calculations = runtime_calc($script_end_time, $script_start_time);

        return View::make('show-users')->with(['number_of_users' => $number_of_users,
                                                'number_fetched' => $number_fetched,
                                                'users' => $users_university_list,
                                                'time_calculations' => $time_calculations
        ]);
    }

    /**
     * @param integer $count
     * generate and add $count users with faker database seeder to database
     * @return mixed
     */
	public function addUsers($count)
	{
		// start runtime calculator
		$script_start_time = microtime(true);

		// create a Croatian faker
		$faker = Faker\Factory::create('hr_HR');

		//get all universities to array for later usage
		$universities = University::all();
		$universities_id_list = [];
		foreach ($universities as $university) {
            array_push($universities_id_list, $university->id);
		}
		$first_university_id = $universities_id_list[0];
		$last_university_id = end($universities_id_list);

		// prepare array defaults
		$seeds_storage = [];

		// number of records
		$number_of_seeds = $count;

		// create random records and add to helper temp array
		try {
			for ($i = 0; $i < $number_of_seeds; $i++) {
				if ($i % 2 == 0) {
					$seed['first_name'] = $faker->firstNameMale;
				} else {
					$seed['first_name'] = $faker->firstNameFemale;
				}

                $randomized_num = random_number_string(15);
				$seed['last_name'] = $faker->lastName;
				$seed['username'] = mb_strtolower(safe_name($seed['last_name'])).mb_strtolower(mb_substr($seed['first_name'], 0, 1, 'utf-8')).$randomized_num;
                $seed['avatar'] = 'https://placeholdit.imgix.net/~text?txtsize=15&txt='.$seed['username'].'e&w=150&h=150';
				$seed['email'] = mb_strtolower(safe_name($seed['first_name'])).'.'.mb_strtolower(safe_name($seed['last_name'])).$randomized_num.'@gmail.com';
				$seed['password'] = Hash::make(random_string(15));
                $seed['university_id'] = rand($first_university_id, $last_university_id);

				//add to array
				array_push($seeds_storage, $seed);
			}

			//how many seeds are added
			$number_of_seeds = count($seeds_storage);

			//add records to database
			foreach ($seeds_storage as $seed) {
				$user = new User;

				$user->first_name = $seed['first_name'];
				$user->last_name = $seed['last_name'];
				$user->username = $seed['username'];
                $user->avatar = $seed['avatar'];
				$user->email = $seed['email'];
				$user->password = $seed['password'];
                $user->university_id = $seed['university_id'];

				$user->save();
			}
		}
		catch(Exception $e){
			$script_time_limit = ini_get('max_execution_time');
            return "Skripta je premašila vrijeme izvršavanja od ".$script_time_limit." sek.";
		}

		$script_end_time = microtime(true);
		$time_calculations = runtime_calc($script_end_time, $script_start_time);

		return View::make('add-users')->with(['seeds_storage' => $seeds_storage,
                                                'universities' => $universities,
												'number_of_seeds' => $number_of_seeds,
												'time_calculations' => $time_calculations
											]);
	}

    /**
     * delete all users from database
     * @return mixed
     */
    public function deleteUsers()
    {
        // start runtime calculator
        $script_start_time = microtime(true);

        // get count of records and delete them
        $number_of_deleted = User::count();
        DB::table('users')->delete();

        $script_end_time = microtime(true);
        $time_calculations = runtime_calc($script_end_time, $script_start_time);

        return View::make('delete-users')->with(['number_of_deleted' => $number_of_deleted,
                                                'time_calculations' => $time_calculations
        ]);
    }

	/**
	 * add user manually form page
	 * @return mixed
	 */
	public function addUserManualFormPage()
	{
		// start runtime calculator
		$script_start_time = microtime(true);

		//get all universities from DB to populate dropdown
		$user_universities = University::orderBy('id')->lists('university', 'id');
		$seeds_storage = '';

		$script_end_time = microtime(true);
		$time_calculations = runtime_calc($script_end_time, $script_start_time);

		return View::make('add-user-manual')->with(['seeds_storage' => $seeds_storage,
													'user_universities' => $user_universities,
													'time_calculations' => $time_calculations
		]);
	}

	/**
	 * add user manually
	 * @return mixed
	 */
	public function addUserManual()
	{
		// start runtime calculator
		$script_start_time = microtime(true);

		//get all universities from DB to populate dropdown
		$user_universities = University::orderBy('id')->lists('university', 'id');

		//get form data
		$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
		$user_data = ['first_name' => e(Input::get('first_name')),
						'last_name' => e(Input::get('last_name')),
						'username' => e(Input::get('username')),
						'email' => e(Input::get('email')),
						'password' => e(Input::get('password')),
						'password_again' => e(Input::get('password_again'))
		];

		$user_university_id = (int)e(Input::get('user_university'));

		//validation
		$validator = Validator::make($user_data, User::$rules, User::$messages);

		//check if csrf token is valid
		if(Session::token() != $token){
			$script_end_time = microtime(true);
			$time_calculations = runtime_calc($script_end_time, $script_start_time);
			$error_message = 'CSRF token nije važeći.';
			$error_list = explode(' ', $error_message);

			return View::make('add-user-manual')->with(['errors_list' => $error_list,
														'user_universities' => $user_universities,
														'time_calculations' => $time_calculations
			]);
		}
		else{
			//check validation results and save user if ok
			if($validator->fails()){
				$script_end_time = microtime(true);
				$time_calculations = runtime_calc($script_end_time, $script_start_time);

				return View::make('add-user-manual')->with(['errors_list' => $validator->getMessageBag()->toArray(),
															'user_universities' => $user_universities,
															'time_calculations' => $time_calculations
				]);
			}
			else{
				$user = new User;
				$randomized_num = random_number_string(15);
				$user->first_name = e($user_data['first_name']);
				$user->last_name = e($user_data['last_name']);
				$user->username = e($user_data['username']);
				$user->avatar = 'https://placeholdit.imgix.net/~text?txtsize=15&txt='.e($user_data['username']).'e&w=150&h=150';
				$user->email = e($user_data['email']);
				$user->password = Hash::make($user_data['password']);
				$user->university_id = $user_university_id;
				$user->save();

				$script_end_time = microtime(true);
				$time_calculations = runtime_calc($script_end_time, $script_start_time);

				return View::make('add-user-manual')->with(['success_list' => 'Korisnik je uspješno dodan.',
															'user_universities' => $user_universities,
															'time_calculations' => $time_calculations
				]);
			}
		}
	}
}
