# MonkeyData PHP Online Store XML feed generator

[![Latest Stable Version](https://poser.pugx.org/monkey-data/eshop-xml-feed-generator/v/stable)](https://packagist.org/packages/monkey-data/eshop-xml-feed-generator)
[![License](https://poser.pugx.org/monkey-data/eshop-xml-feed-generator/license)](https://packagist.org/packages/monkey-data/eshop-xml-feed-generator)


## Documentation of MonkeyData XML Library

Thank you for choosing our library for implementation. The library is prepared to easily implement XML feed for MonkeyData. We've tried to correct all types of possible errors which could happen during the library implementation to ensure maximum reliability, data and time sophistication.

The library is build to simplify creating of your XML file with orders from your online store with parametres of order dates from and to the specific date. It also implements two basic ways of authentization, which can be set in the MonkeyData library itself. You don't have to care about the outgoing XML structure, correct headings or security questions, if you don't want to.

## Library instalation
### Composer
Require this package with composer using the following command
```bash
composer require monkey-data/online-store-xml-feed-generator
```
### Direct
Download the library in "resources" section, then unzip it anywhere to your project. Usually, the external libraries are localized in folders "libs", "vendor" or similar. Everything depends on your online store solution. It's also possible to run the library completely off your project, independently. For implemeation just create web space and coby the library there.

### Implementation example
We've prepared an example for quick and easy implementation.  Open the adress with your library in your browser. For example: https://localhost/vas-eshop/vendor/MonkeyData/?hash=123456. If this web space is accessible (not forbiden via .htaccess), a sample XML will appear in the window (start of index.php). If you have a space for scripts in you application, which is not publicly accessible, put the file index.php into the public part of your application and rewrite tracks to files in require functions.

File index.php contents these lines:

```php
require_once __DIR__ . '/MonkeyDataXmlModel.php';
require_once __DIR__ . '/MonkeyDataExampleXmlGenerator.php';

$xmlGenerator = new MonkeyDataExampleXmlGenerator();
$xmlGenerator->run();
```


If you've done everything correctly, the sample XML will open in your browser. 

Now it's the right time to explain what is the meaning of these files and how to ensure your output XML will display real orders correctly instead the sample one.

File autoloader.php is responsible for loading all required classes. It consist MyAutoloud function, which is put into the queue of all autolouders (if the queue of autolouders is not active, it activates automatically) and opens whole MonkeyData library to your online store. You can use your own autoloader, of course. In that case the library location is in namespace MonkeyData/XmlGenerator/... . Namespace fully corresponds with the directory structure, which should make the implementation easier.

MonkeyDataXmlModel.php is the specific implementation of a basic XmlModel and consists 7 basic functions (you'll implement these) with a sample of output, it also consist connection settings for MySQL database via PDO and security settings (description in the particular section). 

MonkeyDataExampleXmlGenerator.php is the class, which connects our MonkeyDataXmlModel with the library, which later generates output XML.

### Implementation
Your task is to implement the model with the predefined interface (CurrentXmlModelInterface). The interface sets 7 basic functions, into which you'l programme the selection of data from your e-shop database. 
```php
getOrdersItems()
getPaymentsItems()
getShippingsItems()
getProductsItems()
getOrderStatusesItems()
getCustomersItems()
getCategoriesItems()
```
Detailed description of particular function is in sections itselves, where every behavior aspect and links for the rest of the library are described.

For an easy instalation we've prepared mysql database connection via PDO (in the model in class variant $this->connection). If you decide to use prepared PDO, set the login to your database in the heading of the model.
```php
protected $config = array(
        'database' => array(
            'use' => true,
            'host' => "localhost",
            'name' => "db_name",
            'user' => "db_user",
            'pass' => "db_pass"
        ),
        'security' => array(
            'hash' => "123456",
            'login' => "john",
            'pass' => "dow"
        )
    );
```


In this field $config is also possible to set basic security. The basic security is solved with security hash or login / password combination. These can be used during the connection of a project in MonkeyData administration.


## Feedback

Please submit issues, and send your feedback and suggestions as often as you have them.

In case of need, contact MonkeyData developers on email api@monkeydata.com.
