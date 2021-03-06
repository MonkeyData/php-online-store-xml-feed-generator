# MonkeyData PHP Online Store XML feed generator

[![Latest Stable Version](https://poser.pugx.org/monkey-data/online-store-xml-feed-generator/v/stable)](https://packagist.org/packages/monkey-data/online-store-xml-feed-generator)
[![License](https://poser.pugx.org/monkey-data/online-store-xml-feed-generator/license)](https://packagist.org/packages/monkey-data/online-store-xml-feed-generator)


## Documentation of MonkeyData XML Library
Thank you for choosing our library for implementation. The library is prepared to easily implement the XML feed for MonkeyData. We've tried to correct all types of possible errors which could happen during the library implementation to ensure maximum reliability, data and time sophistication.

The library is built to simplify the creation of your XML file with orders from your online store with parameters of order dates from and to the specific date. It also implements two basic ways of authentication, which can be set in the MonkeyData library itself. You don't have to worry about the outgoing XML structure, correct headings or security questions, if you don't want to.

## Library instalation
Note: Minimum required version of PHP is 5.3.0
#### 1. Composer
Require this package with composer using the following command
```bash
composer require monkey-data/online-store-xml-feed-generator
```
#### 2. Direct

https://github.com/MonkeyData/php-online-store-xml-feed-generator/archive/master.zip

Download the library in the "resources" section, then unzip it anywhere to your project. Usually, the external libraries are placed in folders "libs", "vendor" or somewhere similar. Everything depends on your online store solution. It's also possible to run the library completely off your project, independently. For implementation just create the web space and code the library there.

### Quick implementation example

1. There is an 'example' folder where you find 3 files with example implementations without a composer autoload. 
These files are to be copied to a folder that is accessible from your web browser.

2. A model 'MonkeyDataXmlModel' should be edited according to your database structure in order to get all needed data out of DB.

### Security
A hash is used for security’s sake. After installation a random hash is generated, but you are advised to set your own in 'config.hash'

**hash is required**

For instance (do not use this example):
```
b6eb6a84aeac1f937c354dc3b826c83e
```

Your url feed must contain a hash parameter. For example:
```
https://{domain}/{path_to_generator_script}/?hash={hash}
https://domain.com/monkeydata-generator/?hash=b6eb6a84aeac1f937c354dc3b826c83e
```


### Implementation example

We've prepared an example for quick and easy implementation. Open the address with your library in your browser. For example: https://localhost/vas-eshop/vendor/MonkeyData/?hash=123456. If this web space is accessible (not forbidden via .htaccess), a sample XML will appear in the window (start of index.php). If you have a space for scripts in your application, which is not publicly accessible, put the file index.php into the public part of your application and rewrite tracks to files in require functions.

File index.php contents these lines:

```php
// MonkeyDataExampleXmlGenerator should be loaded via autoload

$xmlGenerator = new MonkeyDataExampleXmlGenerator();
$xmlGenerator->run();
```


If you've done everything correctly, the sample XML will open in your browser. 

Now it's the right time to explain the meaning of these files and how to ensure your output XML will display real orders correctly instead of the sample one.

File autoloader.php is responsible for loading all required classes. It consists of MyAutoloud function, which is put into the queue of all autolouders (if the queue of autolouders is not active, it activates automatically) and opens the whole MonkeyData library to your online store. You can use your own autoloader, of course. In that case the library location is in the namespace MonkeyData/XmlGenerator/... . Namespace fully corresponds with the directory structure, which should make the implementation easier.

MonkeyDataXmlModel.php is the specific implementation of a basic XmlModel and consists 7 basic functions (you'll implement these) with a sample of output, it also consists of connection settings for MySQL database via PDO and security settings (description in the particular section).

MonkeyDataExampleXmlGenerator.php is the class, which connects our MonkeyDataXmlModel with the library, which later generates the XML output.

### Implementation
Your task is to implement the model with the predefined interface (CurrentXmlModelInterface). The interface sets 7 basic functions, into which you'll program the selection of data from your e-shop database.
```php
getOrdersItems()
getPaymentsItems()
getShippingsItems()
getProductsItems()
getOrderStatusesItems()
getCustomersItems()
getCategoriesItems()
```
Detailed descriptions of particular functions are in the sections itselves, where every behavior aspect and links for the rest of the library are described.

For easy installation, we've prepared a mysql database connection via PDO (in the model in class variant $this->connection). If you decide to use prepared PDO, set the login to your database in the heading of the model.
```php
protected $config = array(
        'database' => array(
            'use' => true,
            'host' => "localhost",
            'name' => "db_name",
            'user' => "db_user",
            'pass' => "db_pass"
        )
    );
```


## Feedback

Please submit issues, and send your feedback and suggestions as often as you have them.

In case you need help, contact MonkeyData developers by email at [api@monkeydata.com](mailto:api@monkeydata.com).
