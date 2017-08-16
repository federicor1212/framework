General Details
----------------

Here you'll find the MVC structure of an entire framework will follow, if you need to create one.

.htaccess is used by apache to be a single point of entry

Index.php is used as a entry-point file.

MVC (model-view-controller) structure i create is the following:


Main Directories:
------------------

Application directory is the web app’s directory;

Framework directory is for the framework itself;

Public directory is to store all the public static resources like html, css and js files.



Inside application Directory:
-----------------------------

Config Directory - stores the app’s configuration files

Controllers Directory - this is for all app’s Controller classes

Model Directory - this is for all app’s Model classes

View Directory - this is for all app’s View classes



Inside Framework Directory:
---------------------------

Core Directory - it will store the framework’s core classes

Database Directory - database related classes, such as database driver classes

Helpers Directory - help/assistant functions

Libraries Directory - for class libraries


Inside Public directory:
-------------------------

Css Directory - for css files

Images Directory - for images files

Js Directory - for javascript files

Uploads Directory - for uploaded files, such as uploaded images



Routing and autoloading
------------------------

Module autoloading is implemented with spl_autoload_register() function

Routing is implemented with dispatch method inside Framework Class.



Database Information
--------------------

DATABASE CAN BE CREATED WITH THE FOLLOWING QUERY

CREATE SCHEMA fede_framework;
USE fede_framework;

CREATE TABLE Books (
    id int,
    book_name varchar(255),
    book_isbn varchar(255)
);

INSERT INTO `books` (`id`, `book_name`, `book_isbn`) VALUES (1, 'COOK BOOK I', '0-2645-2641-1');
INSERT INTO `books` (`id`, `book_name`, `book_isbn`) VALUES (2, 'COOK BOOK II', '0-2645-2641-2');
