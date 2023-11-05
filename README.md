# UzmiKnjigu

The "UzmiKnjigu" project is a platform designed for the buying and selling of educational books. It was developed as a part of the "Internet Technologies and Programming" course during the fourth year at the Faculty of Electrical Engineering in East Sarajevo.

## Key Features

The "UzmiKnjigu" project provides several key features:

- User Registration: Publicly accessible functionality that allows users to register by filling out a form with their contact information and specifying whether they are buying, selling, or both. Account activation requires approval from an administrator.

- Title Management: Administrators can record book titles, including book names, categories (primary/secondary school, grade), and other relevant details.

- Book Management: Sellers and administrators can record specific books, including price, condition (poor/average/excellent), book images, year of publication, status (available/reserved/sold), and other relevant information.

- Book Search: Users can search for books based on various parameters, such as title, category, grade, condition, price range, and other criteria.

- Book Reservation: Registered users can reserve books for purchase.

- Reporting for Sellers: Sellers can review sales reports for any arbitrary time period.

## Getting Started

To successfully run this project, follow these steps:

1. Clone the project to your local machine and place it in the `xampp/htdocs` directory on your XAMPP server.

2. In terminal, run these two commands: 
```
composer install
composer dump-autoload
```

3. Import the database by executing the SQL dump file `bookstore.sql`.

4. Update the configuration file in `Configuration.php` with your database credentials.

5. In your terminal, run the following commands to install the required dependencies: 
```  
yarn add package.json
```  

The project is now successfully installed and ready to use on `http:\\localhost`.

## Technologies Used

The "UzmiKnjigu" project utilizes a range of technologies for its development:

### Frontend Development
- HTML
- CSS
- Bootstrap (CSS framework for responsive web development)
- Bootstrap Icons (Bootstrap add-on for icon libraries)
- JavaScript
- jQuery (JavaScript library)

### Backend Development
- PHP programming language
- Twig template engine (used within the PHP Symfony framework) for user interface development
- MySQL database

### Additional Tools
- Composer (PHP Autoloader)
- Yarn (Software packaging system)

## MVC and Core System

The project employs the Model-View-Controller (MVC) architecture for code organization. The core system includes routing mechanisms, session management, validations, abstract API controllers, and models with methods for fetching by ID, fetching all entities, and searching by fields.

Additionally, the project has implemented security measures to protect against SQL injection and session hijacking attacks, ensuring the safety of data.

## Authors

This application was developed as part of a project at the Faculty of Electrical Engineering in East Sarajevo. The authors are:

- Danijela Milanovic
- Stefan Jokic (https://github.com/stefanjokic99)

## License

This application was created for educational purposes and is available under an open license. Feel free to use and adapt it to your needs.

## Contact

For any additional information or questions, you can contact the authors at danijelamilanovic222@gmail.com, stefan.jokic99@hotmail.com.
