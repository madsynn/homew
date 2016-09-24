<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProductFakerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('ProductFaker', function($app) {
		$faker = \Faker\Factory::create();
		$newClass = new class($faker) extends \Faker\Provider\Base {

				public function NAME($nbWords = 5)
				{
					$sentence = $this->generator->sentence($nbWords);
					return substr($sentence, 0, strlen($sentence) - 1);
				}

				 public function PRICE($nbWords = 5)
				{
					$sentence = $this->generator->sentence($nbWords);
					return substr($sentence, 0, strlen($sentence) - 1);
				}

				public function UPC()
				{
					return $this->generator->ean13();
				}


			};

		$faker->addProvider($newClass);

		return $faker;
	});
	}
}
// Here is an example provider for populating Book data:

// <?php

// namespace Faker\Provider;

// class Book extends \Faker\Provider\Base
// {
//   public function title($nbWords = 5)
//   {
//     $sentence = $this->generator->sentence($nbWords);
//     return substr($sentence, 0, strlen($sentence) - 1);
//   }

//   public function ISBN()
//   {
//     return $this->generator->ean13();
//   }
// }
// To register this provider, just add a new instance of \Faker\Provider\Book to an existing generator:

// <?php
// $faker->addProvider(new \Faker\Provider\Book($faker));
// Now you can use the two new formatters like any other Faker formatter:

// <?php
// $book = new Book();
// $book->setTitle($faker->title);
// $book->setISBN($faker->ISBN);
// $book->setSummary($faker->text);
// $book->setPrice($faker->randomNumber(2));
// Tip: A provider can also be a Plain Old PHP Object. In that case, all the public methods of the provider become available to the generator.
