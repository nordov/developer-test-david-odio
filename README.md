<p align="center"><a href="https://www.guildmortgage.com/" target="_blank"><img src="https://www.guildmortgage.com/wp-content/uploads/2016/11/Guild_Logo_RGB_Full.png" width="25%"></a></p>

# PHP / Laravel Developer test for David Odio

## Given

- You have a loan application
  - The loan application has 2 borrowers
    - One borrower has a job
    - The other borrower has a job and a bank account

## Requirements

- Clone this git repository and create a feature branch for your changes
- Install a fresh copy of Laravel
- Create some simple database tables to represent the above scenario
  - By simple I mean just the basics of what's really needed for this exercise
  - For example, the borrower should have a name, but we don't need date of birth, social security number or contact information for this exercise
  - Though I would like to see the standard date fields as part of the design (ie. created, updated, deleted)
- Write a query (or queries) that shows the total annual income and bank account values for the application
- Expose an API end point to show the results of the query (or queries)
  - All output should be in JSON format
- Write a unit test on at least one method in the project
  - I'm deliberatly keeping this requirement vague to give you freedom to decide what to test and how
- Update this README file with any installation instructions needed so we can clone and run your code
- Commit your feature branch back to this repository

## What I'm looking for

- Your general skill-set with PHP and MySQL
- Your general architecture skills
- How well you know your way around Laravel
- Your ability to write unit tests
- Coding style
- How well you adhere to the PSR standards
- Usage of design patterns in your code

## Finally...

Don't be afraid to get creative and have some fun!

## Installation instructions

- Pull loan-app-feature branch
- Run composer install to get dependencies
- Database file database,sqlite is included with some records on it so migration should not be necessary, but you can reset the DB if you like
- Run PHP server (php artisan serve)
- Use Postman or Insomnia to try the following API routes:
  - GET     /api/loan-application:      Displays all loan applications
  - GET     /api/loan-application/{id}: Displays detail of loan application referenced by id. Returns 404 if not found
  - POST    /api/loan-application:      Records new loan application. All it requires is a loan amount to save record but if not all information is provided it will return a notice listing missing info.
  - PUT     /api/loan-application/{id}  Updates only information regarding loan application such as amount and status. 
  - DELETE  /api/loan-application/{id}  Deletes record refered by id, returns 404 if not found

The following JSON object can be used to POST API:

{
	"loan_application_amount":36000.00,
	"borrowers": [
		{
			"fname":"Tony",
			"lname":"Stark",
			"employment" : [
				{
					"employeer_name":"Stark Industries",
					"annual_income":65000.00
				},
				{
					"employeer_name":"Avengers",
					"annual_income":15000.00
				}			
			],
			"bank_accounts":[
				{
					"bank_name":"Wells Fargo",
					"account_number":"12345678",
					"balance":27000.00
				}				
			]
		},
		{
			"fname":"Bruce",
			"lname":"Banner",
			"employment" : [
				{
					"employeer_name":"Avengers",
					"annual_income":35000.00
				}		
			],
			"bank_accounts":[
				{
					"bank_name":"Wells Fargo",
					"account_number":"12345678",
					"balance":27000.00
				},
				{
					"bank_name":"Union Bank",
					"account_number":"12345678",
					"balance":27000.00
				}					
			]
		}		
	]
}
